@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Transaction Detail</h3>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($total = 0)
                        @forelse ($carts as $cart)
                            @php($total += $cart->product->price * $cart->quantity)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cart->product->title }}</td>
                                <td>Rp.{{ number_format($cart->product->price, 2) }}</td>
                                <td>{{ $cart->quantity }}</td>
                                <td>Rp.{{ number_format($cart->product->price * $cart->quantity, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <h6>Cart is empty</h6>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                    <h6 class="text-end">Grand Total: Rp.{{ number_format($total, 2) }}</h6>
            </div>
        </div>
    </div>
@endsection
