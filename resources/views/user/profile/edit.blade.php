@extends('user.layouts.master')

@section('content')
    <div class="row" style="margin-top: 7rem">
        <h4 class="offset-2"><a href="{{ route('user#profile', $user->id) }}">Profile</a> > Edit</h4>
        <div class="p-3 rounded shadow-sm col-8 offset-2 card">

            <form action="{{ route('user#profile#update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="mb-3">
                        @php
                            $photo = $user->profile;
                            $isUrl = filter_var($photo, FILTER_VALIDATE_URL);
                        @endphp

                        <img class="mb-1 img-profile w-25" id="output"
                            src="{{ $photo ? ($isUrl ? $photo : asset('uploads/profile/' . $photo)) : asset('admin_template/img/undraw_profile.svg') }}">

                        <p hidden>{{ $user->profile }}</p>
                        <p hidden>{{ asset('uploads/profile/' . ($user->profile ?? 'undraw_posting_photo.svg')) }}</p>

                        <input type="file" name="image" accept="image/*" id=""
                            class="mt-1 form-control @error('image') is-invalid @enderror" value=""
                            onchange="loadFile(event)">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="row">
                        <div class="col">

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="{{ old('name') ? old('name') : $user->name }}"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name...">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>
                        </div>

                        <div class="col">

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" name="email"
                                    value="{{ old('email') ? old('email') : $user->email }}"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email...">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>
                        </div>



                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone"
                                        value="{{ old('phone') ? old('phone') : $user->phone }}"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="Enter Phone Number...">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address"
                                        value="{{ old('address') ? old('address') : $user->address }}"
                                        class="form-control @error('address') is-invalid @enderror"
                                        placeholder="Enter Address...">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="submit" value="Update Profile" class="rounded shadow-sm btn btn-primary w-100">
                        </div>
                    </div>
            </form>


        </div>

    </div>
@endsection
