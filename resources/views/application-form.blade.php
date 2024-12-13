<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lesotho Hub</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animations/animate.min.css') }}">

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">


    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .logout-btn {
            border: none;
            color: white;
        }

        .logout-btn:hover {
            background-color: #ff0000;
            /* Red hover color */
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="#" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>Lesotho Hub</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        
        @auth
        Welcome, {{ Auth::user()->name }}
        @endauth
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ url('/') }}" class="nav-item nav-link">Home</a>
                <a href="{{ url('/about-us') }}" class="nav-item nav-link">About</a>
                <a href="{{ url('/courses') }}" class="nav-item nav-link">Courses</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="{{ url('/team') }}" class="dropdown-item">Our Team</a>
                        <a href="{{ url('/testimonial') }}" class="dropdown-item">Testimonial</a>
                    </div>
                </div>
                <a href="{{ url('/contact-us') }}" class="nav-item nav-link">Contact</a>
            </div>
            @guest
            <!-- Show this if the user is NOT logged in -->
            <a href="" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">
                Join Now <i class="fa fa-arrow-right ms-3"></i>
            </a>
            @endguest

            @auth
            <!-- Show this if the user IS logged in -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    <!-- Button with hover applied directly to the button -->
                    <div class="btn btn-primary py-4 px-lg-5 d-none d-lg-block logout-btn">
                        {{ __('Log Out') }} <i class="fa fa-arrow-right ms-3"></i>
                    </div>
                </x-dropdown-link>
            </form>

            @endauth
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                @if ($institution->image != "")
                    <img class="image-thumbnail border rounded-circle mb-3"  width="100" height="100" src="{{ asset('uploads/institutions/'.$institution->image) }}" alt="Profile Picture">
                    @endif
                    <h1 class="display-3 text-white animated slideInDown">{{ $institution->name }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Team</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1>Application Form</h1>







            <section class="h-100 bg-dark">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col">
                            <div class="card card-registration my-4">
                                <div class="row g-0">
                                    <div class="col-xl-6 d-none d-xl-block">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                                            alt="Sample photo" class="img-fluid"
                                            style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="card-body p-md-5 text-black">
                                            <h3 class="mb-5 text-uppercase">faculty of {{ $faculty->name }}</h3>

                                            <form enctype="multipart/form-data" action="{{ route('products.store', $institution->id) }}" method="post">
                                                @csrf
                                                <div class="row">
                                                <input type="hidden" name="institution_id" value="{{ $institution->id }}"> <!-- Hidden field for institution_id -->
                                                    <!-- First Name -->
                                                    <div class="mb-3">
                                                        <label for="first_name" class="form-label h5">First Name</label>
                                                        <input type="text" id="first_name" class="@error('first_name') is-invalid @enderror form-control-lg form-control" placeholder="First Name" name="first_name" value="{{ old('first_name') }}">
                                                        @error('first_name')
                                                        <p class="invalid-feedback">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Last Name -->
                                                    <div class="mb-3">
                                                        <label for="last_name" class="form-label h5">Last Name</label>
                                                        <input type="text" id="last_name" class="@error('last_name') is-invalid @enderror form-control-lg form-control" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}">
                                                        @error('last_name')
                                                        <p class="invalid-feedback">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Mother's Name -->
                                                    <div class="mb-3">
                                                        <label for="mother_name" class="form-label h5">Mother's Name</label>
                                                        <input type="text" id="mother_name" class="@error('mother_name') is-invalid @enderror form-control-lg form-control" placeholder="Mother's Name" name="mother_name" value="{{ old('mother_name') }}">
                                                        @error('mother_name')
                                                        <p class="invalid-feedback">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Father's Name -->
                                                    <div class="mb-3">
                                                        <label for="father_name" class="form-label h5">Father's Name</label>
                                                        <input type="text" id="father_name" class="@error('father_name') is-invalid @enderror form-control-lg form-control" placeholder="Father's Name" name="father_name" value="{{ old('father_name') }}">
                                                        @error('father_name')
                                                        <p class="invalid-feedback">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Address -->
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label h5">Address</label>
                                                        <input type="text" id="address" class="@error('address') is-invalid @enderror form-control-lg form-control" placeholder="Address" name="address" value="{{ old('address') }}">
                                                        @error('address')
                                                        <p class="invalid-feedback">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Gender -->
                                                    <div class="mb-3">
                                                        <label class="form-label h5">Gender</label><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="Female">
                                                            <label class="form-check-label" for="femaleGender">Female</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" id="maleGender" value="Male">
                                                            <label class="form-check-label" for="maleGender">Male</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" id="otherGender" value="Other">
                                                            <label class="form-check-label" for="otherGender">Other</label>
                                                        </div>
                                                    </div>


                                                    <!-- Course Selection -->
                                                    <div class="mb-3">
                                                        <label for="course_id" class="form-label h5">Course</label>
                                                        <select name="course_name" class="form-control-lg form-control" id="course_name">
                                                            <option value="">Select a Course</option> <!-- Make sure the default option has an empty value -->
                                                            @foreach ($courses as $course)
                                                            <option value="{{ $course->name }}">{{ $course->name }}</option>
                                                            @endforeach
                                                        </select>


                                                    </div>

                                                    <!-- District Selection -->
                                                    <div class="mb-3">
                                                        <label for="district" class="form-label h5">District</label>
                                                        <select class="form-control-lg form-control" id="district" name="district">
                                                            <option value="Berea">Berea</option>
                                                            <option value="Butha-Buthe">Butha-Buthe</option>
                                                            <option value="Leribe">Leribe</option>
                                                            <option value="Mafeteng">Mafeteng</option>
                                                            <option value="Maseru">Maseru</option>
                                                            <option value="Mohale s Hoek">Mohale's Hoek</option>
                                                            <option value="Mokhotlong">Mokhotlong</option>
                                                            <option value="Qacha s Nek">Qacha's Nek</option>
                                                            <option value="Quthing">Quthing</option>
                                                            <option value="Thaba-Tseka">Thaba-Tseka</option>
                                                        </select>
                                                    </div>

                                                    <!-- Date of Birth -->
                                                    <div class="mb-3">
                                                        <label for="dob" class="form-label h5">Date of Birth</label>
                                                        <input type="date" id="dob" class="form-control-lg form-control" name="dob">
                                                    </div>

                                                    <!-- Email -->
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label h5">Email</label>
                                                        <input type="email" id="email" class="@error('email') is-invalid @enderror form-control-lg form-control" placeholder="limko@gmail.com" name="email" value="{{ old('email') }}">
                                                        @error('email')
                                                        <p class="invalid-feedback">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- File Upload -->
                                                    <div class="mb-3">
                                                        <label for="results" class="form-label h5">Results</label>
                                                        <input type="file" id="results" class="form-control-lg form-control" name="results">
                                                        <div class="small text-muted mt-2">Upload your LGCSE Results/Certificate or any other relevant file. Max file size 50 MB</div>
                                                    </div>

                                                    <!-- Submit Button -->
                                                    <div class="d-grid">
                                                        <button class="btn btn-lg btn-primary">Apply</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- Display success or error messages -->
                                            @if (session('success'))
                                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                            @endif

                                            @if (session('error'))
                                            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Team End -->





<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-white mb-3">Quick Link</h4>
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                        <a class="btn btn-link" href="">FAQs & Help</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-white mb-3">Contact</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Mafafa Street, Maseru, Lesotho</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+266 57990805</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>Lesothohub@co.ls</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-white mb-3">Gallery</h4>
                        <div class="row g-2 pt-2">
                            <div class="col-4">
                                <img class="img-fluid bg-light p-1" src="{{ asset('images/course-1.jpg') }}" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid bg-light p-1" src="{{ asset('images/course-2.jpg') }}" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid bg-light p-1" src="{{ asset('images/course-3.jpg') }}" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid bg-light p-1" src="{{ asset('images/course-2.jpg') }}" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid bg-light p-1" src="{{ asset('images/course-3.jpg') }}" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid bg-light p-1" src="{{ asset('images/course-1.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-white mb-3">Newsletter</h4>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">LESOTHO HUB</a>, All Right Reserved.

                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a class="border-bottom" href="#">KHATALA KHANG</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/wow.min.js') }}"></script>
        <script src="{{ asset('js/easing.min.js') }}"></script>
        <script src="{{ asset('js/waypoints.min.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>

        <!-- Template Javascript -->
        <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>