<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\UserAddress;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index');
        }

        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'province_name' => 'required',
            'city_name' => 'required',
            'district_name' => 'required',
            'city_id' => 'required',
            'courier' => 'required|string',
            'courier_service' => 'required|string',
            'shipping_cost' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            // Dummy user id for now if not logged in
            $userId = Auth::check() ? Auth::id() : 1; // Assuming a user with ID 1 exists

            $address = UserAddress::create([
                'user_id' => $userId,
                'label' => 'Alamat Pengiriman',
                'recipient_name' => $request->recipient_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'province' => $request->province_name,
                'city' => $request->city_name,
                'district' => $request->district_name,
                'postal_code' => $request->zip_code ?? '',
                'city_id' => $request->city_id, // This is actually the Komerce Destination ID now
                'is_primary' => true,
            ]);

            $order = Order::create([
                'user_id' => $userId,
                'user_address_id' => $address->id,
                'invoice_num' => Order::generateInvoiceNumber(),
                'courier' => strtoupper($request->courier),
                'courier_service' => $request->courier_service,
                'tracking_number' => null,
                'subtotal' => $total,
                'shipping_cost' => $request->shipping_cost,
                'grand_total' => $total + $request->shipping_cost,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'qty' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                // Reduce stock
                $product = Product::find($productId);
                if ($product) {
                    $product->decrement('stock', $item['quantity']);
                }
            }

            // Create Midtrans Payment
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $order->invoice_num,
                    'gross_amount' => $order->grand_total,
                ],
                'customer_details' => [
                    'first_name' => $request->recipient_name,
                    'phone' => $request->phone,
                ],
                'callbacks' => [
                    'finish' => route('dashboard')
                ]
            ];

            $snapToken = 
            Snap::getSnapToken($params);

            Payment::create([
                'order_id' => $order->id,
                'snap_token' => $snapToken,
                'amount' => $order->grand_total,
                'status' => 'pending',
            ]);

            DB::commit();

            session()->forget('cart');

            return redirect()->route('checkout.success', $order->id)->with('success', 'Pesanan Anda berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }
    
    public function success($id)
    {
        $order = Order::with('payment', 'address')->findOrFail($id);
        
        // Block access if it's not the user's order and they are logged in. For guest, ideally secure it better, but fine for now.
        if (Auth::check() && $order->user_id !== Auth::id() && $order->user_id !== 1) {
            abort(403);
        }

        return view('checkout.success', compact('order'));
    }

    public function callback(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        
        try {
            $notification = new Notification();
            $transaction = $notification->transaction_status;
            $type = $notification->payment_type;
            $orderId = $notification->order_id;
            $fraud = $notification->fraud_status;
            
            $order = Order::where('invoice_num', $orderId)->firstOrFail();
            $payment = Payment::where('order_id', $order->id)->firstOrFail();
            
            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $payment->update(['status' => 'pending']); // or you could leave it as pending since challenge isn't in ENUM
                    } else {
                        $payment->update(['status' => 'settlement']);
                        $order->update(['status' => 'paid']);
                    }
                }
            } else if ($transaction == 'settlement') {
                $payment->update([
                    'status' => 'settlement',
                    'payment_type' => $type,
                    'paid_at' => now(),
                    'midtrans_response' => $notification->getResponse()
                ]);
                $order->update(['status' => 'paid']);
            } else if ($transaction == 'pending') {
                $payment->update(['status' => 'pending']);
            } else if ($transaction == 'deny') {
                $payment->update(['status' => 'failed']);
                $order->update(['status' => 'cancelled']);
            } else if ($transaction == 'expire') {
                $payment->update(['status' => 'expired']);
                $order->update(['status' => 'cancelled']);
            } else if ($transaction == 'cancel') {
                $payment->update(['status' => 'failed']);
                $order->update(['status' => 'cancelled']);
            }
            
            return response()->json(['message' => 'Callback received']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
