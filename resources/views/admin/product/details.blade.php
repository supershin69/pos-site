@extends('admin.layouts.master')

@section('content')
    <div class="container my-4 bg-white rounded shadow-sm">
        <div class="row align-items-start">
            <!-- Left: Image -->
            <div class="col-md-4">
                <div class="overflow-hidden rounded" style="max-height: 600px">
                    <img src="{{ asset('uploads/' . $product->image) }}" alt="Product" class="img-fluid w-100"
                        style="object-fit: contain; background-color: #f8f9fa;">
                </div>
            </div>

            <!-- Right: Text info -->
            <div class="col-md-8">
                <h3 class="mt-3 mb-2 fw-bold"><strong>Product Name:</strong> {{ $product->name }}</h3>

                <p class="mb-1"><strong>Stock: </strong> <button class="btn btn-secondary">{{ $product->stock }} </button>
                </p>

                <p class="mb-1"><strong>Category:</strong> {{ $product->category_name }}</p>
                <p class="mb-1"><strong>Price:</strong> {{ $product->price }}</p>
                <p class="mt-3">{{ $product->description }}</p>
            </div>
        </div>
    </div>
@endsection
