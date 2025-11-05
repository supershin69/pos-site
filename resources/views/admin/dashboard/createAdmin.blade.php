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
                                        <h1 class="mb-4 text-gray-900 h4">Create Admins Here</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('superadmin.create-new-admin') }}">
                                        @csrf

                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email"
                                                value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                        </div>


                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control form-control-user class="@error('superpassword') is-invalid @enderror"
                                                id="superpassword" placeholder="Super Admin Password" name="superpassword"
                                                value="">

                                            @error('superpassword')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            create
                                        </button>
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

@if (Session::has('message'))
    @push('scripts')
        <script>
            Swal.fire({
                title: "{{ Session::get('message') }}",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            });
            console.log('hello');
        </script>
    @endpush
@endif

@if (Session::has('error'))
    @push('scripts')
        <script>
            Swal.fire({
                title: "{{ Session::get('error') }}",
                icon: "error",
                showConfirmButton: false,
                timer: 1500
            });
            console.log('error');
        </script>
    @endpush
@endif
