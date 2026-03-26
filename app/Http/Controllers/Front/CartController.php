<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // Cannot add more than stock
        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Kuantitas melebihi stok yang tersedia.');
        }

        $cart = session()->get('cart', []);

        $price = $product->discount_price && $product->discount_price < $product->price 
                 ? $product->discount_price 
                 : $product->price;

        if (isset($cart[$product->id])) {
            $newQuantity = $cart[$product->id]['quantity'] + $request->quantity;
            if ($newQuantity > $product->stock) {
                return back()->with('error', 'Kuantitas total melebihi stok yang tersedia.');
            }
            $cart[$product->id]['quantity'] = $newQuantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => $request->quantity,
                'price' => $price,
                'image' => $product->image,
                'slug' => $product->slug,
                'unit' => $product->unit,
                'max_stock' => $product->stock
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            $product = Product::findOrFail($request->id);
            if ($request->quantity > $product->stock) {
                 return back()->with('error', 'Kuantitas melebihi stok yang tersedia.');
            }
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui!');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang!');
    }
}
