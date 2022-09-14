@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- search --}}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="GET">
                            <div class="form-group mb-3">
                                <label for="search">Search</label>
                                <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                        class="img-fluid">
                        <div class="card-body">
                            <h5>{{ $product->title }}</h5>
                            <p>{{ $product->description }}</p>
                            <a href="{{ route('detail', $product->id) }}" class="btn btn-primary w-100">Product Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
