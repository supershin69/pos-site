@extends('admin.layouts.master');

@section('content')
    <div class="container">
        <h3 class="ms-4"><a href="{{ $user->role == 'admin' ? route('admin#list') : route('user#list') }}">Back</a></h3>
    </div>
    <div class="p-3 border-0 shadow-sm card rounded-4" style="max-width: 400px; margin: auto;">
        <div class="text-center">
            @php
                // Determine profile photo
                $photo = null;

                if ($user->profile) {
                    // Case 1: Local uploaded photo
                    if (Str::startsWith($user->profile, ['http://', 'https://'])) {
                        $photo = $user->profile; // Social login (Google/GitHub)
                    } else {
                        $photo = asset('uploads/' . $user->profile); // Local file
                    }
                } else {
                    // Case 2: Default avatar
                    $photo = asset('admin_template/img/undraw_profile.svg');
                }
            @endphp

            <img src="{{ $photo }}" alt="Profile Photo" class="border rounded-circle"
                style="width: 120px; height: 120px; object-fit: cover;">

            <h5 class="mt-3 fw-semibold text-dark">
                {{ $user->name }}
            </h5>
            <span class="mb-3 text-white text-uppercase badge d-block bg-primary">{{ ucfirst($user->role) }}</span>
        </div>

        <div class="pt-0 card-body">
            <ul class="list-group list-group-flush">
                <li class="px-0 border-0 list-group-item d-flex justify-content-between align-items-center">
                    <strong>Email</strong>
                    <span class="text-muted">{{ $user->email ?? '-' }}</span>
                </li>
                <li class="px-0 border-0 list-group-item d-flex justify-content-between align-items-center">
                    <strong>Phone</strong>
                    <span class="text-muted">{{ $user->phone ?? '—' }}</span>
                </li>
                <li class="px-0 border-0 list-group-item d-flex justify-content-between align-items-center">
                    <strong>Address</strong>
                    <span class="text-muted text-end">
                        {{ $user->address ?? 'Not Provided' }}
                    </span>
                </li>
            </ul>
        </div>
    </div>
@endsection
