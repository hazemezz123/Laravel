@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h1 class="text-center mb-3">All Products</h1>
    
    @foreach ($products as $product)
        <div class="card p-3 mb-3">
            <h5 class="card-header">Product: {{ $product->id }} - {{ $product->created_at->format('Y-m-d') }}</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" class="img-fluid rounded">
                    </div>
                    <div class="col-md-9">
                        <h3 class="card-title">{{ $product->title }}</h3>
                        <h5 class="card-title text-muted">{{ $product->brand }}</h5>
                        <p class="card-text">{{ \Str::limit($product->description, 100) }}</p>
                        <a href="#" class="btn btn-primary">detail</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
@endsection 