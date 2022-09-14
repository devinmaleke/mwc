<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (request()->has('search')) {
            if (request()->search == '') {
                $products = Product::all();
            } else {
                $products = Product::where('title', 'like', '%' . request()->search . '%')->get();
            }
        } else {
            $products = Product::all();
        }
        return view('home', compact('products'));
    }

    public function detail($id)
    {
        $product = Product::with('category')->find($id);
        return view('detail', compact('product'));
    }

    public function cart()
    {
        $ada = Transaction::where('user_id', Auth::user()->id)->where('status', 0)->count();
        if ($ada == 0) {
            $transaction = new Transaction();
            $transaction->id = 0;
        } else {
            $transaction = Transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();
        }
        $carts = TransactionDetail::with('product')->where('transaction_id', $transaction->id)->get();
        return view('cart', compact('carts'));
    }

    public function transaction()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        return view('transaction', compact('transactions'));
    }

    public function transactionDetail($id)
    {
        $transaction = Transaction::find($id);
        $carts = TransactionDetail::with('product')->where('transaction_id', $transaction->id)->get();
        return view('transaction-detail', compact('carts'));
    }

    public function cartDestroy($id)
    {
        TransactionDetail::destroy($id);
        return redirect()->back();
    }
}
