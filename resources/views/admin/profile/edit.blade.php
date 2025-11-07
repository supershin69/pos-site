@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-6 offset-3">
            <div class="ms-5">
                <a href="{{ route('admin#profile', auth()->user()->id) }}">Profile</a> > Edit
            </div>
            <div class="card">
                <div class="shadow card-body">
                    <form action=" {{ route('profile#update', auth()->user()->id) }}" method="post" class="p-3 rounded "
                        enctype="multipart/form-data">
                        @csrf

                        <img src="{{ auth()->user()->profile ? asset('uploads/profile/' . auth()->user()->profile) : asset('admin_template/img/undraw_profile.svg') }}"
                            alt="" class="mb-3 w-25 d-block" id="output">

                        <input type="file" name="profile" class="mb-3" onchange="loadFile(event)">

                        <input type="text" name="name" value="{{ old('name') ? old('name') : auth()->user()->name }}"
                            class=" form-control @error('name') is-invalid @enderror" placeholder="Enter Name...">
                        @error('name')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror

                        <input type="submit" value="Update" class="mt-3 btn btn-outline-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
