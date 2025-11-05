@extends('admin.layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="border-0 shadow-lg card rounded-4" style="width: 22rem;">
                <div class="p-4 text-center card-body">
                    <img src="{{ auth()->user()->profile ? asset('uploads/profile/' . auth()->user()->profile) : asset('admin_template/img/undraw_profile.svg') }}"
                        class="mb-3 shadow-sm rounded-circle" alt="Profile Photo" width="120" height="120"
                        style="object-fit: cover;">
                    <h5 class="mb-1 card-title fw-bold">{{ auth()->user()->name }}</h5>
                    <p class="mb-2 text-muted">{{ auth()->user()->email }}</p>
                    <span class="px-3 py-2 text-white badge bg-primary rounded-pill text-uppercase">
                        {{ auth()->user()->role }}
                    </span>
                    <a href="{{ route('profile#edit', auth()->user()->id) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
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
                timer: 1300
            });
            console.log('hello');
        </script>
    @endpush
@endif
