@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-6 offset-3">
        <div class="ms-5">
            <a href="{{ route('CategoryList') }}">Category</a> > Edit
        </div>
        <div class="card">
            <div class="shadow card-body">
                <form action=" {{ route('category#update', $category->id) }}" method="post" class="p-3 rounded ">
                @csrf

                    <input type="text" name="categoryName" value="{{ old('categoryName') ? old('categoryName') : $category->name }}" class=" form-control @error('categoryName') is-invalid @enderror"
                            placeholder="Category Name...">
                    @error('categoryName')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror

                        <input type="submit" value="Update" class="mt-3 btn btn-outline-primary">
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection