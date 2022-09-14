<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $ada = Transaction::where('user_id', Auth::user()->id)->where('status', 0)->count();
        if ($ada == 0) {
            Transaction::create([
                'user_id' => Auth::user()->id,
                'status' => 0,
            ]);
            $transaction = Transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();
        } else {
            $transaction = Transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();
        }

        $sudah = TransactionDetail::where('transaction_id', $transaction->id)->where('product_id', $request->product_id)->count();
        if ($sudah == 0) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        } else {
            $add = TransactionDetail::where('transaction_id', $transaction->id)->where('product_id', $request->product_id)->first();
            TransactionDetail::where('transaction_id', $transaction->id)->where('product_id', $request->product_id)->update([
                'quantity' => $add->quantity + $request->quantity,
            ]);
        }
        $product = Product::where('id', $request->product_id)->first();
        $product->stock = $product->stock - $request->quantity;
        $product->save();
        return redirect()->back();
    }
}
