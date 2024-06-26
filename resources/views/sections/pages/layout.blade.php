<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RLC Residences | Leasing - @yield('title')</title>

    @section('links')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css">
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
            <nav class="navbar navbar-expand-lg bg-body-tertiary px-xxl-3 py-xxl-3 fixed-top">
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
                            <li class="nav-item">
                                <a class="nav-link {{ Request::url() == url('/for-sale') ? 'active' : '' }}" href="/for-sale">For Sale</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::url() == url('/for-lease') ? 'active' : '' }}" href="/for-lease">For Lease</a>
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
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::url() == url('/about-us') ? 'active' : '' }}" href="/about-us">About Us</a>
                            </li>

                            <li class="contact_btns d-flex align-items-center justify-content-center">
                                <a class="fa-solid fa-mobile-screen-button" id='mobile' href=''></a>
                                <a class="fa-brands fa-facebook-messenger" id='messenger' href='' target='_blank'></a>
                                <a class="fa-brands fa-telegram" id='telegram' href='' target='_blank'></a>
                                <a class="fa-brands fa-weixin" id='wechat' href='' target='_blank'></a>
                                <a class="fa-brands fa-viber" id='viber' href='' target='_blank'></a>
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
                        <div class="row">
                            <div class="col-6">
                                <a href="/">Home</a>
                                <a href="/for-sale">For Sale</a>
                                <a href="/for-lease">For Lease</a>
                                <a href="/compare">Compare Properties</a>
                                <a href="/calculator">Loan Calculator</a>
                            </div>
                            <div class="col-6">
                                <a href="/contact-us">Contact Us</a>
                                <a href="/submit-review">Submit a Review</a>
                                <a href="/unit-registration">Unit Registration</a>
                                <a href="/about-us">About Us</a>
                            </div>
                        </div>
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
                                <br><br>
                                <a class="fa-brands fa-weixin" id='wechat' href='' target='_blank'></a>
                                <span id='wechat_text'></span>
                            </div>
                            <div class="col-xxl-6">
                                <a class="fa-solid fa-mobile-screen-button" id='mobile' href='' ></a>
                                <span id='mobile_text'></span>
                                <br><br>
                                <a class="fa-brands fa-telegram" id='telegram' href='' target='_blank'></a>
                                <span id='telegram_text'></span>
                                <br><br>
                                <a class="fa-brands fa-viber" id='viber' href='' target='_blank'></a>
                                <span id='viber_text'></span>
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

            <div class="mx-5" id="google_translate_element"></div>
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

        <script>
            var botmanWidget = {
                aboutText: 'Start the conversation with Hi',
                introMessage: "Welcome to RLC Residences"
            };
        </script>

        <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/dc08c6c264.js" crossorigin="anonymous"></script>

        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

        <script src="{{ asset('js/pages/settings.js') }}"></script>

        <script type="text/javascript">
            function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
            }
        </script>
    @show
</body>
</html>