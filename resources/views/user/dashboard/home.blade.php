@extends('user.layouts.master')

@section('content')
    <!-- Fruits Shop Start-->
    <div class="py-5 mt-5 container-fluid fruite">
        <div class="container py-5">
            <div class="text-center tab-class">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Our Products</h1>
                    </div>
                    <div class="col-lg-8 text-end">
                        <ul class="mb-5 text-center nav nav-pills d-inline-flex">
                            {{-- All Products --}}
                            <li class="nav-item">
                                <a class="py-2 m-2 d-flex rounded-pill 
            {{ request('category_name') ? 'bg-light text-dark' : 'bg-secondary text-white' }}"
                                    href="{{ route('user#home') }}">
                                    <span style="width: 130px;">All Products</span>
                                </a>
                            </li>

                            {{-- Dynamic category buttons --}}
                            @php
                                $categories = ['Phones', 'Laptops', 'Tablets', 'Accessories'];
                            @endphp

                            @foreach ($categories as $category)
                                <li class="nav-item">
                                    <a class="py-2 m-2 d-flex rounded-pill 
                {{ request('category_name') === $category ? 'bg-secondary text-white' : 'bg-light text-dark' }}"
                                        href="{{ route('user#home', ['category_name' => $category]) }}">
                                        <span style="width: 130px;">{{ $category }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="tab-1" class="p-0 tab-pane fade show active">
                            <div class="row g-4">
                                <div class="col-3">
                                    <div class="form">
                                        <form action="" method="get">

                                            <div class="input-group">
                                                <input type="text" name="searchKey" value="" class=" form-control"
                                                    placeholder="Enter Search Key...">
                                                <button type="submit" class="btn"> <i
                                                        class="fa-solid fa-magnifying-glass"></i> </button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="mt-3 row">
                                        <div class="col-12">
                                            <form action="" method="get">

                                                <input type="text" name="minPrice" value=""
                                                    placeholder="Minimum Price..." class="my-2 form-control">
                                                <input type="text" name="maxPrice" value=""
                                                    placeholder="Maximum Price..." class="my-2 form-control">
                                                <input type="submit" value="Search" class="my-2 btn btn-success w-100">
                                            </form>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <form action="" method="get">

                                                <select name="sortingType" class="mt-3 bg-white form-control w-100">

                                                </select>

                                                <input type="submit" value="Sort" class="my-3 btn btn-success w-100">
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-9">
                                    <div class="row g-4">


                                        @foreach ($products as $product)
                                            <div class="col-4">
                                                <div class="rounded position-relative fruite-item">
                                                    <div class="fruite-img">
                                                        <a href="{{ route('user#product#details', $product->id) }}"><img
                                                                src="{{ asset('uploads/' . $product->image) }}"
                                                                style="height: 250px" class="img-fluid w-100 rounded-top"
                                                                alt=""></a>
                                                    </div>
                                                    <div class="px-3 py-1 text-white rounded bg-secondary position-absolute"
                                                        style="top: 10px; left: 10px;">{{ $product->category_name }}</div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4 class="text-start">{{ $product->name }}</h4>
                                                        <p></p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="mb-0 text-dark fs-5 fw-bold">{{ $product->price }} MMK
                                                            </p>
                                                            <a href="#"
                                                                class="px-3 border btn border-secondary rounded-pill text-primary"><i
                                                                    class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                                cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach



                                    </div>
                                    <div class="mt-3 d-flex justify-content-center">{{ $products->links() }}</div>

                                    <style>
                                        /* Debug override */
                                        ul.pagination {
                                            display: flex !important;
                                            flex-wrap: wrap;
                                            gap: 5px;
                                        }

                                        ul.pagination li {
                                            display: inline-block !important;
                                        }
                                    </style>

                                </div>

                            </div>

                        </div>

                        <div id="tab-2" class="p-0 tab-pane fade show">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="{{ asset('user_template/img/fruite-item-5.jpg') }}"
                                                        class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="px-3 py-1 text-white rounded bg-secondary position-absolute"
                                                    style="top: 10px; left: 10px;">Fruits</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Grapes</h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                        eiusmod te incididunt</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="mb-0 text-dark fs-5 fw-bold">$4.99 / kg</p>
                                                        <a href="#"
                                                            class="px-3 border btn border-secondary rounded-pill text-primary"><i
                                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                            cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="img/fruite-item-2.jpg" class="img-fluid w-100 rounded-top"
                                                        alt="">
                                                </div>
                                                <div class="px-3 py-1 text-white rounded bg-secondary position-absolute"
                                                    style="top: 10px; left: 10px;">Fruits</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Raspberries</h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                        eiusmod te incididunt</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="mb-0 text-dark fs-5 fw-bold">$4.99 / kg</p>
                                                        <a href="#"
                                                            class="px-3 border btn border-secondary rounded-pill text-primary"><i
                                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                            cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-3" class="p-0 tab-pane fade show">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="img/fruite-item-1.jpg" class="img-fluid w-100 rounded-top"
                                                        alt="">
                                                </div>
                                                <div class="px-3 py-1 text-white rounded bg-secondary position-absolute"
                                                    style="top: 10px; left: 10px;">Fruits</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Oranges</h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                        eiusmod te incididunt</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="mb-0 text-dark fs-5 fw-bold">$4.99 / kg</p>
                                                        <a href="#"
                                                            class="px-3 border btn border-secondary rounded-pill text-primary"><i
                                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                            cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="img/fruite-item-6.jpg" class="img-fluid w-100 rounded-top"
                                                        alt="">
                                                </div>
                                                <div class="px-3 py-1 text-white rounded bg-secondary position-absolute"
                                                    style="top: 10px; left: 10px;">Fruits</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Apple</h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                        eiusmod te incididunt</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="mb-0 text-dark fs-5 fw-bold">$4.99 / kg</p>
                                                        <a href="#"
                                                            class="px-3 border btn border-secondary rounded-pill text-primary"><i
                                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                            cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-4" class="p-0 tab-pane fade show">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top"
                                                        alt="">
                                                </div>
                                                <div class="px-3 py-1 text-white rounded bg-secondary position-absolute"
                                                    style="top: 10px; left: 10px;">Fruits</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Grapes</h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                        eiusmod te incididunt</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="mb-0 text-dark fs-5 fw-bold">$4.99 / kg</p>
                                                        <a href="#"
                                                            class="px-3 border btn border-secondary rounded-pill text-primary"><i
                                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                            cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="img/fruite-item-4.jpg" class="img-fluid w-100 rounded-top"
                                                        alt="">
                                                </div>
                                                <div class="px-3 py-1 text-white rounded bg-secondary position-absolute"
                                                    style="top: 10px; left: 10px;">Fruits</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Apricots</h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                        eiusmod te incididunt</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="mb-0 text-dark fs-5 fw-bold">$4.99 / kg</p>
                                                        <a href="#"
                                                            class="px-3 border btn border-secondary rounded-pill text-primary"><i
                                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                            cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-5" class="p-0 tab-pane fade show">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="img/fruite-item-3.jpg" class="img-fluid w-100 rounded-top"
                                                        alt="">
                                                </div>
                                                <div class="px-3 py-1 text-white rounded bg-secondary position-absolute"
                                                    style="top: 10px; left: 10px;">Fruits</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Banana</h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                        eiusmod te incididunt</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="mb-0 text-dark fs-5 fw-bold">$4.99 / kg</p>
                                                        <a href="#"
                                                            class="px-3 border btn border-secondary rounded-pill text-primary"><i
                                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                            cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="img/fruite-item-2.jpg" class="img-fluid w-100 rounded-top"
                                                        alt="">
                                                </div>
                                                <div class="px-3 py-1 text-white rounded bg-secondary position-absolute"
                                                    style="top: 10px; left: 10px;">Fruits</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Raspberries</h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                        eiusmod te incididunt</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="mb-0 text-dark fs-5 fw-bold">$4.99 / kg</p>
                                                        <a href="#"
                                                            class="px-3 border btn border-secondary rounded-pill text-primary"><i
                                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                            cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="img/fruite-item-1.jpg" class="img-fluid w-100 rounded-top"
                                                        alt="">
                                                </div>
                                                <div class="px-3 py-1 text-white rounded bg-secondary position-absolute"
                                                    style="top: 10px; left: 10px;">Fruits</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Oranges</h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                        eiusmod te incididunt</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="mb-0 text-dark fs-5 fw-bold">$4.99 / kg</p>
                                                        <a href="#"
                                                            class="px-3 border btn border-secondary rounded-pill text-primary"><i
                                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                            cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->
    @endsection
