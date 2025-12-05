<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

        return view('checkout.index', compact('product'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'shipping_type' => 'required',
            'payment_method' => 'required',
        ]);

        $product = Product::findOrFail($request->product_id);
        $shippingCost = $request->shipping_type === 'express' ? 25000 : 15000;

        $transaction = Transaction::create([
            'buyer_id' => Auth::id(),
            'store_id' => $product->store_id,
            'code' => Str::random(8),
            'address' => $request->address,
            'shipping_type' => $request->shipping_type,
            'shipping_cost' => $shippingCost,
            'grand_total' => $product->price + $shippingCost,
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
        } 
        else {
            return redirect()->route('payment.va', $transaction->id);
        }
    }
}