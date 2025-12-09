<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::findOrFail($request->product);

        // Ambil data toko dari product
        $store = Store::where('id', $product->store_id)->first();

        // Ambil data user untuk pre-fill
        $user = Auth::user();

        return view('checkout.index', compact('product', 'store', 'user'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'shipping_type' => 'required',
            'payment_method' => 'required',
        ]);

        $product = Product::findOrFail($request->product_id);
        $store   = $product->store; // ambil data city & postal_code toko

        $shippingCost = match ($request->shipping_type) {
            'express' => 20000,   // SiCepat
            'jne'     => 22000,   // JNE
            default   => 17000,   // JNT
        };

        $transaction = Transaction::create([
            'buyer_id'      => Auth::id(),
            'store_id'      => $product->store_id,
            'code'          => Str::upper(Str::random(10)),
            'address'       => $request->address,
            'address_id'    => null,
            'city'          => $store->city ?? 'Unknown',
            'postal_code'   => $store->postal_code ?? '00000',
            'shipping'      => $request->shipping_type == 'express'
                ? 'SiCepat'
                : ($request->shipping_type == 'jne' ? 'JNE' : 'JNT'),
            'shipping_type' => $request->shipping_type,
            'shipping_cost' => $shippingCost,
            'grand_total'   => $product->price + $shippingCost,
            'tax'           => 0,
            'payment_status' => 'unpaid',
        ]);

        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
            'qty' => 1,
            'subtotal' => $product->price
        ]);

        if ($request->payment_method == 'wallet') {
            return redirect()->route('payment.wallet', $transaction->id);
        } else {
            return redirect()->route('payment.va', $transaction->id);
        }
    }
}
