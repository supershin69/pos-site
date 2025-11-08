@extends('user.layouts.master')

@section('content')
    <div class="p-3 border-0 shadow-sm card rounded-4 position-relative"
        style="max-width: 400px; margin: auto; margin-top: 16rem;">
        <a href="{{ route('user#profile#edit', auth()->user()->id) }}"
            class="btn btn-sm btn-outline-secondary position-absolute" style="top: 15px; right: 15px;">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>

        <div class="text-center">
            @php
                $photo = null;
                if (auth()->user()->profile) {
                    if (Str::startsWith(auth()->user()->profile, ['http://', 'https://'])) {
                        $photo = auth()->user()->profile;
                    } else {
                        $photo = asset('uploads/profile/' . auth()->user()->profile);
                    }
                } else {
                    $photo = asset('admin_template/img/undraw_profile.svg');
                }
            @endphp

            <img src="{{ $photo }}" alt="Profile Photo" class="border rounded-circle"
                style="width: 120px; height: 120px; object-fit: cover;">

            <h5 class="mt-3 fw-semibold text-dark">{{ auth()->user()->name }}</h5>
            <span class="mb-3 text-white text-uppercase badge d-block bg-primary">{{ ucfirst(auth()->user()->role) }}</span>
        </div>

        <div class="pt-0 card-body">
            <ul class="list-group list-group-flush">
                <li class="px-0 border-0 list-group-item d-flex justify-content-between align-items-center">
                    <strong>Email</strong>
                    <span class="text-muted">{{ auth()->user()->email ?? '-' }}</span>
                </li>
                <li class="px-0 border-0 list-group-item d-flex justify-content-between align-items-center">
                    <strong>Phone</strong>
                    <span class="text-muted">{{ auth()->user()->phone ?? '—' }}</span>
                </li>
                <li class="px-0 border-0 list-group-item d-flex justify-content-between align-items-center">
                    <strong>Address</strong>
                    <span class="text-muted text-end">
                        {{ auth()->user()->address ?? 'Not Provided' }}
                    </span>
                </li>
            </ul>
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
