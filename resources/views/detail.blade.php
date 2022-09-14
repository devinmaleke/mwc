@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{-- detail product --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $product->title }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                    class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <h4>{{ $product->title }}</h4>
                                <p>{{ $product->description }}</p>
                                <p>Price : Rp. {{ number_format($product->price, 2) }}</p>
                                <p>Stok : {{ $product->stock }} piece(s)</p>
                                @auth
                                    @if (Auth::user()->role == 'customer')
                                        <form action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="number" class="form-control mb-3" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
