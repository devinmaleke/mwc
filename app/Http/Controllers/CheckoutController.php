<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Transaction::where('user_id', Auth::user()->id)->where('status', 0)->update([
            'total_price' => $request->total_price,
            'status' => 1,
        ]);
        return redirect()->route('home');
    }
}
