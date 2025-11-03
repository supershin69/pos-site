@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="p-3 rounded shadow-sm col-8 offset-2 card">

                <form action="{{ route('product#create') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="mb-3">
                            <img class="mb-1 img-profile w-25" id="output"
                                src="{{ asset('uploads/undraw_posting_photo.svg') }}">
                            <input type="file" name="image" accept="image/*" id=""
                                class="mt-1 form-control @error('image') is-invalid @enderror" onchange="loadFile(event)">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter Product Name...">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Category Name</label>
                                    <select name="categoryId" id="" class="form-control "
                                        value="{{ old('categoryId') }}">
                                        <option value="">Choose Category...</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}"
                                                @if ($item->id == old('categoryId')) selected @endif>{{ $item->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('categoryId')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="text" name="price" value="{{ old('price') }}"
                                        class="form-control @error('price') is-invalid @enderror"
                                        placeholder="Enter Price...">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Stock</label>
                                    <input type="text" name="stock" value="{{ old('stock') }}"
                                        class="form-control @error('stock') is-invalid @enderror"
                                        placeholder="Enter Stock...">
                                    @error('stock')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="" cols="30" rows="10"
                                class="form-control @error('description') is-invalid @enderror" placeholder="Enter Description...">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <input type="submit" value="Create Product" class="rounded shadow-sm btn btn-primary w-100">
                        </div>
                    </div>
                </form>


            </div>

        </div>
    </div>
@endsection
