<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RLC Residences | Leasing - @yield('title')</title>

    @section('links')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/pages/styles.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <style>
            @font-face {
                font-family: MuseoSans;
                src: url({{ asset('fonts/MuseoSans_500.otf') }});
            }
        </style>
    @show

    <script src="{{ asset('vendor/admin/jquery/jquery.min.js') }}"></script>
</head>

<body style="background-image: url({{ asset('img/pages/main-bg.png') }});">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col loader d-flex align-items-center justify-content-center">
                <div class="text-center">
                    <img src="{{ asset('img/pages/loading_logo.png') }}" alt="">
                    <h3>Loading website for the first time.</h3>
                    <h5>This may take awhile...</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        @section('navbar')
            <nav class="navbar navbar-expand-lg bg-body-tertiary px-xxl-5 py-xxl-3 fixed-top">
                <div class="container-fluid navbar_div">
                    <a href="/" class="navbar-brand">
                        <img src="{{ asset('img/pages/logo.png') }}" alt="" id='logo'>
                    </a>

                    <button class="nav_toggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars"></i>
                    </button>
            
                    <div class="collapse navbar-collapse justify-content-end nav-items" id='navbarContent'>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::url() == url('/') ? 'active' : '' }}" href="/">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link {{ in_array(Request::url(), [ url('/for-sale'), url('/for-lease') ]) ? 'active' : '' }} dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Units
                                  </a>
                                <ul class="dropdown-menu unit_drop">
                                    <li><a class="dropdown-item" href="/for-sale">For Sale</a></li>
                                    <li><a class="dropdown-item" href="/for-lease">For Lease</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::url() == url('/compare') ? 'active' : '' }}" href="/compare">Compare Properties</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link {{ in_array(Request::url(), [ url('/contact-us'), url('/submit-review'), url('/unit-registration') ]) ? 'active' : '' }} dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  Contact Us
                                </a>
                                <ul class="dropdown-menu" id='contact_drop'>
                                  <li><a class="dropdown-item" href="/contact-us">Send Inquiry</a></li>
                                  <li><a class="dropdown-item" href="/submit-review">Submit Review</a></li>
                                  <li><a class="dropdown-item" href="/unit-registration">Unit Registration</a></li>
                                  <li><a class="dropdown-item" id='mobile' href=''>
                                        <i class="fa-solid fa-mobile-screen-button"></i>
                                        <p>Mobile</p>
                                      </a>
                                  </li>
                                  <li><a class="dropdown-item" id='messenger' href='' target='_blank'>
                                        <i class="fa-brands fa-facebook-messenger"></i>
                                        <p>Messenger</p>
                                      </a>
                                  </li>
                                  <li><a class="dropdown-item" id='telegram' href='' target='_blank'>
                                        <i class="fa-brands fa-telegram"></i>
                                        <p>Telegram</p>
                                      </a>
                                  </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::url() == url('/about-us') ? 'active' : '' }}" href="/about-us">About Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        @show

        @yield('content')

        @section('footer')
            <div class="container-fluid footer px-5">
                <div class="row">
                    <div class="col-xxl-3">
                        <h3>Quick Links</h3>
                        <a href="/">Home</a>
                        <a href="/for-sale">For Sale</a>
                        <a href="/for-lease">For Lease</a>
                        <a href="/compare">Compare Properties</a>
                        <a href="/contact-us">Contact Us</a>
                        <a href="/about-us">About Us</a>
                    </div>
                    <div class="col-xxl-3 offset-xxl-1 contacts">
                        <h3>Talk to Us</h3>
                        <p>
                            <b id='office'></b><br>
                            <span id='address'></span><br>
                            <span id='email'></span>
                        </p>

                        <div class="row">
                            <div class="col-xxl-6">
                                <a class="fa-solid fa-phone" id='telephone' href='' target='_blank'></a>
                                <span id='telephone_text'></span>
                                <br><br>
                                <a class="fa-brands fa-facebook-messenger" id='messenger' href='' target='_blank'></a>
                                <span id='messenger_text'></span>
                            </div>
                            <div class="col-xxl-6">
                                <a class="fa-solid fa-mobile-screen-button" id='mobile' href='' ></a>
                                <span id='mobile_text'></span>
                                <br><br>
                                <a class="fa-brands fa-telegram" id='telegram' href='' target='_blank'></a>
                                <span id='telegram_text'></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 offset-xxl-2 contact_us">
                        <h3>Stay Updated</h3>
                        
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email address">
                            <button class="btn btn-warning text-light">Subscribe Now</button>
                        </div>

                        <div class="text-xxl-start text-center mt-5">
                            <a class="fa-brands fa-facebook-f fa-2x" href='' target='_blank' id='facebook'></a>
                            <a class="fa-brands fa-x-twitter fa-2x" href='' target='_blank' id='twitter'></a>
                            <a class="fa-brands fa-instagram fa-2x" href='' target='_blank' id='instagram'></a>
                            <a class="fa-brands fa-youtube fa-2x" href='' target='_blank' id='youtube'></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center mt-4 copyright">
                        <p>© 2023 RLC Residences. Residential Division of Robinsons Land Corporation. A Subsidiary of JG Summit Holdings, Inc.</p>
                    </div>
                </div>
            </div>
        @show
    </div>

    @section('scripts')
        <script>
            $(window).on('load', function() {
                $('.loader').fadeOut(1000)
                $('.loader').toggleClass('d-none')
                $('.content').fadeIn(1000)
            })
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/dc08c6c264.js" crossorigin="anonymous"></script>

        <script src="{{ asset('js/pages/settings.js') }}"></script>
    @show
</body>
</html>