<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user_template/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user_template/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user_template/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('user_template/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('user_template/css/custom.css') }}">

</head>

<body>





    <!-- Navbar start -->
    <div class="container-fluid fixed-top">

        <div class="container px-0">
            <nav class="bg-white navbar navbar-light navbar-expand-xl">
                <a href="index.html" class="navbar-brand">
                    <h1 class="text-primary display-6">TechReich</h1>
                </a>
                <button class="px-3 py-2 navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="bg-white collapse navbar-collapse" id="navbarCollapse">
                    <div class="mx-auto navbar-nav">
                        <a href="{{ route('user#home') }}" class="nav-item nav-link ">Shop</a>
                        <a href="" class="nav-item nav-link">Cart</a>
                        <a href="#" class="nav-item nav-link">Contact</a>

                    </div>
                    <div class="m-3 d-flex me-0">

                        <a href="" class="my-auto position-relative me-4">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                        </a>
                        <a href="" class="my-auto position-relative me-4">
                            <i class="fa-solid fa-list-check fa-2x"></i>
                        </a>
                        <div class="nav-item dropdown">
                            <a href="#" class="my-auto mt-2 nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                @php
                                    $profile = auth()->user()->profile;
                                    $isUrl = filter_var($profile, FILTER_VALIDATE_URL);
                                @endphp
                                <img src="{{ $profile
                                    ? ($isUrl
                                        ? $profile
                                        : asset('uploads/profile/' . $profile))
                                    : asset('admin_template/img/undraw_profile.svg') }}"
                                    style="width: 50px; height: 50px;" class="img-profile rounded-circle"
                                    alt="">
                                <span></span>
                            </a>
                            <div class="m-0 dropdown-menu bg-secondary rounded-0">
                                <a href="{{ route('user#profile', auth()->user()->id) }}"
                                    class="my-2 dropdown-item">View Profile</a>
                                <a href="{{ route('user#profile#edit', auth()->user()->id) }}"
                                    class="my-2 dropdown-item">Edit Profile</a>

                                <a href="#" class="mt-2 dropdown-item">Change Password</a>
                                <form action="{{ route('logout') }}" method="post">\
                                    @csrf

                                    <input type="submit" value="Logout"
                                        class="mb-3 rounded btn btn-outline-success w-100">
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    @yield('content');




    <!-- Footer Start -->
    <div class="pt-5 mt-5 container-fluid bg-dark text-white-50 footer">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="mb-0 text-primary">Fruitables</h1>
                            <p class="mb-0 text-secondary">Fresh products</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="mx-auto position-relative">
                            <input class="px-4 py-3 border-0 form-control w-100 rounded-pill" type="number"
                                placeholder="Your Email">
                            <button type="submit"
                                class="px-4 py-3 text-white border-0 btn btn-primary border-secondary position-absolute rounded-pill"
                                style="top: 0; right: 0;">Subscribe Now</button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="pt-3 d-flex justify-content-end">
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="mb-3 text-light">Why People Like us!</h4>
                        <p class="mb-4">typesetting, remaining essentially unchanged. It was
                            popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                        <a href="" class="px-4 py-2 btn border-secondary rounded-pill text-primary">Read
                            More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="mb-3 text-light">Shop Info</h4>
                        <a class="btn-link" href="">About Us</a>
                        <a class="btn-link" href="">Contact Us</a>
                        <a class="btn-link" href="">Privacy Policy</a>
                        <a class="btn-link" href="">Terms & Condition</a>
                        <a class="btn-link" href="">Return Policy</a>
                        <a class="btn-link" href="">FAQs & Help</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="mb-3 text-light">Account</h4>
                        <a class="btn-link" href="">My Account</a>
                        <a class="btn-link" href="">Shop details</a>
                        <a class="btn-link" href="">Shopping Cart</a>
                        <a class="btn-link" href="">Wishlist</a>
                        <a class="btn-link" href="">Order History</a>
                        <a class="btn-link" href="">International Orders</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="mb-3 text-light">Contact</h4>
                        <p>Address: 1429 Netus Rd, NY 48247</p>
                        <p>Email: Example@gmail.com</p>
                        <p>Phone: +0123 4567 8910</p>
                        <p>Payment Accepted</p>
                        <img src="img/payment.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="py-4 container-fluid copyright bg-dark">
        <div class="container">
            <div class="row">
                <div class="mb-3 text-center col-md-6 text-md-start mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your
                            Site
                            Name</a>, All right reserved.</span>
                </div>
                <div class="my-auto text-center text-white col-md-6 text-md-end">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a
                        class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user_template/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user_template/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('user_template/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('user_template/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function loadFile(event) {
            var reader = new FileReader();
            reader.onload = function() {
                document.getElementById('output').src = reader.result;
            }

            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    @stack('scripts')

</html>
