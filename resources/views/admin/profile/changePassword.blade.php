@extends('admin.layouts.master')

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="my-5 border-0 shadow-lg card o-hidden">
                    <div class="p-0 card-body">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-8 offset-2">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="mb-4 text-gray-900 h4">Change Your Password</h1>
                                    </div>
                                    <form action="{{ route('password#update', auth()->user()->id) }}" method="POST">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="old_password"><b>Old Password</b></label>
                                            <input type="password" name="old_password" class="form-control"
                                                placeholder="Enter Old Password...">
                                            @error('old_password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="new_password"><b>New Password</b></label>
                                            <input type="password" name="new_password" value="{{ old('new_password') }}"
                                                class="form-control" placeholder="Enter New Password...">
                                            @error('new_password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="new_password_confirmation"><b>Confirm New Password</b></label>
                                            <input type="password" name="new_password_confirmation" class="form-control"
                                                placeholder="Re-enter New Password">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
