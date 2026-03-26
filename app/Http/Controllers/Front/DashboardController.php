<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $statusFilter = $request->query('status');
        $userId = \Illuminate\Support\Facades\Auth::id();

        // 1. Active pre-flight polling of Midtrans status for all pending orders
        // This ensures the database is perfectly synced before we filter and paginate!
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);

        $pendingOrders = Order::with('payment')
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->get();

        foreach ($pendingOrders as $order) {
            if ($order->payment) {
                try {
                    $statusResp = \Midtrans\Transaction::status($order->invoice_num);
                    $status = (object) json_decode(json_encode($statusResp), false); // ensure object
                    
                    if ($status && isset($status->transaction_status)) {
                        $transactionStatus = $status->transaction_status;
                        $fraudStatus = $status->fraud_status ?? null;
                        
                        // Update DB if paid or cancelled
                        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                            if ($fraudStatus == 'challenge') {
                                // challenge isn't in enum, skip or set pending
                                $order->payment->update(['status' => 'pending']);
                            } else {
                                $order->payment->update(['status' => 'settlement', 'paid_at' => now(), 'payment_type' => $status->payment_type ?? null]);
                                $order->update(['status' => 'paid']);
                            }
                        } else if ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                            $order->payment->update(['status' => 'failed']);
                            $order->update(['status' => 'cancelled']);
                        }
                    }
                } catch (\Exception $e) {
                    // Ignore error if transaction not found yet
                }
            }
        }

        // 2. Build the query after DB has been synchronized
        $query = Order::with(['payment', 'items'])->where('user_id', $userId);

        if ($statusFilter && $statusFilter !== 'semua') {
            $query->where('status', $statusFilter);
        }

        $orders = $query->latest()->paginate(10);

        return view('dashboard.index', compact('orders', 'statusFilter'));
    }
}
