@extends('user.layouts.master')

@section('content')
    <div class="py-5 mt-5 container-fluid">
        <div class="container py-5">
            <div class="mb-5 row g-4">
                <div class="col-lg-8 col-xl-9">
                    <a href="{{ route('user#home') }}"> Home </a> <i class="mx-1 mb-4 fa-solid fa-greater-than"></i> Details
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{ asset('uploads/' . $product->image) }}" class="rounded img-fluid"
                                        alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold"></h4>
                            <span class="mb-3 text-danger">({{ $product->stock }} items left ! )</span>
                            <p class="mb-3">Category: {{ $product->category_name }}</p>
                            <h5 class="mb-3 fw-bold">{{ $product->price }} MMK</h5>
                            <div class="mb-4 d-flex">
                                <span class="">

                                </span>

                                <span class=" ms-4">
                                    <i class="fa-solid fa-eye"></i>
                                </span>

                            </div>
                            <p class="mb-4"></p>
                            <form action="" method="post">

                                <input type="hidden" name="userId" value="">
                                <input type="hidden" name="productId" value="">
                                <div class="mb-5 input-group quantity" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="border btn btn-sm btn-minus rounded-circle bg-light">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="count"
                                        class="text-center border-0 form-control form-control-sm" value="1">
                                    <div class="input-group-btn">
                                        <button type="button" class="border btn btn-sm btn-plus rounded-circle bg-light">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="px-4 py-2 mb-4 border btn border-secondary rounded-pill text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>


                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    class="px-4 py-2 mb-4 border btn border-secondary rounded-pill text-primary"><i
                                        class="fa-solid fa-star me-2 text-secondary"></i> Rate this product</button>
                            </form>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Rate this product
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post">

                                            <div class="modal-body">

                                                <input type="hidden" name="productId" value="">

                                                <div class="rating-css">
                                                    <div class="star-icon">
                                                        <input type="radio" value="1" name="productRating" checked
                                                            id="rating1">
                                                        <label for="rating1" class="fa fa-star"></label>
                                                        <input type="radio" value="1" name="productRating" checked
                                                            id="rating2">
                                                        <label for="rating2" class="fa fa-star"></label>
                                                        <input type="radio" value="1" name="productRating" checked
                                                            id="rating3">
                                                        <label for="rating3" class="fa fa-star"></label>
                                                        <input type="radio" value="1" name="productRating"
                                                            id="rating4">
                                                        <label for="rating4" class="fa fa-star"></label>
                                                        <input type="radio" value="1" name="productRating"
                                                            id="rating5">
                                                        <label for="rating5" class="fa fa-star"></label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Rating</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="mb-3 nav nav-tabs">
                                    <button class="border-white nav-link active border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-about" aria-controls="nav-about"
                                        aria-selected="true">Description</button>
                                    <button class="border-white nav-link border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Customer Comments <span
                                            class="shadow-sm btn btn-sm btn-secondary rounted">{{ count($comments) }}</span>

                                    </button>
                                </div>
                            </nav>
                            <div class="mb-5 tab-content">
                                <div class="tab-pane active" id="nav-about" role="tabpanel"
                                    aria-labelledby="nav-about-tab">
                                    <p>{{ $product->description }}</p>
                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel"
                                    aria-labelledby="nav-mission-tab">
                                    <div class="mb-3">
                                        @foreach ($comments as $comment)
                                            @php
                                                $profile = $comment->profile;
                                                $isUrl = filter_var($profile, FILTER_VALIDATE_URL);
                                            @endphp

                                            <div class="mb-3 d-flex">
                                                <img src="{{ $profile
                                                    ? ($isUrl
                                                        ? $profile
                                                        : asset('uploads/profile/' . $profile))
                                                    : asset('admin_template/img/undraw_profile.svg') }}"
                                                    class="p-2 img-fluid rounded-circle"
                                                    style="width: 80px; height: 80px;" alt="Profile">

                                                <div class="ms-3">
                                                    <div class="mb-1 d-flex align-items-center">
                                                        <h5 class="mb-0 me-2">{{ $comment->username }}</h5>
                                                        <small
                                                            class="text-muted">{{ $comment->created_at->format('d M Y, H:i') }}</small>
                                                    </div>
                                                    <p class="mb-0">{{ $comment->message }}</p>
                                                    @if (auth()->user()->id == $comment->user_id)
                                                        <span onclick="deleteConfirm({{ $comment->id }})"
                                                            class="px-2 mt-2 rounded btn btn-outline-danger btn-sm"><i
                                                                class="fa-solid fa-trash-can me-1"></i>Delete</span>
                                                    @endif

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <hr>


                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et
                                        tempor
                                        sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos
                                        labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('user#product#comment') }}" method="post">
                            @csrf

                            <input type="hidden" name="productId" value="">
                            <h4 class="mb-5 fw-bold">
                                Leave a Comments

                            </h4>
                            <input type="hidden" name="userId" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="productId", value="{{ $product->id }}">

                            <div class="row g-1">
                                <div class="col-lg-12">
                                    <div class="rounded border-bottom ">
                                        <textarea name="comment" id="" class="border-0 shadow-sm form-control" cols="30" rows="8"
                                            placeholder="Write your comment..." spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="py-3 mb-5 d-flex justify-content-between">
                                        <button type="submit"
                                            class="px-4 py-3 border btn border-secondary text-primary rounded-pill">
                                            Post
                                            Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">


                    @foreach ($relatedProducts as $item)
                        <div class="border rounded border-primary position-relative vesitable-item">
                            <div class="vesitable-img">
                                <img src="{{ asset('uploads/' . $item->image) }}" style="height: 250px"
                                    class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="px-3 py-1 text-white rounded bg-primary position-absolute"
                                style="top: 10px; right: 10px;">{{ $item->category_name }}</div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4>{{ $item->name }}</h4>
                                <p>{{ Str::words($item->description, 10, '...') }}</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">{{ $item->price }} mmk</p>
                                    <a href="#"
                                        class="px-3 py-1 mb-4 border btn border-secondary rounded-pill text-primary"><i
                                            class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach


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

@push('scripts')
    <script>
        function deleteConfirm(id) {
            console.log(id);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    location.href = "/product/comment/delete/" + id;

                }
            });
        }
    </script>
@endpush
