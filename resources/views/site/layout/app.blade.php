<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('site/assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('site/assets/css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{ asset('site/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/audioplayer.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/jquery.mCustomScrollbar.css') }}">
    <!-- for menue in mobile -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/9.3.0/mmenu.min.css"
        integrity="sha512-nNatP1G6CEh43irXY/GN4cDcLRX/R0jAYAV/ulFZcotSXcuIQE5Do4TuDOYNAD2SCIpmIbaYSllyjTysSCkpEw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('site/assets/css/style.css') }}">
    @yield('css')
    <title>@yield('title')</title>
</head>

<body>


    <div class="splashscreen">
        <div class="loading">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- mobile menu -->
    <nav id="menu">
        <ul>
            <li>
                <a class="mobile-menu-item" @click="closeMenu" href="./index.html">الرئيسية</a>
            </li>
            <li>
                <a class="mobile-menu-item" @click="closeMenu" href="./index.html">المتاجر</a>
            </li>
            <li>
                <a class="mobile-menu-item" @click="closeMenu" href="./index.html">المتاجر</a>
            </li>
            <li>
                <a class="mobile-menu-item" @click="closeMenu" href="./index.html">العروض</a>
            </li>
            <li>
                <a class="mobile-menu-item" @click="closeMenu" href="./index.html">اتصل بنا</a>
            </li>
        </ul>
    </nav>



    @include('site.partials._header1')


    @if (session('message'))
        <div id="notification" class="p-3 rounded text-light"
            style="position: fixed; top: 20px; right: 20px; z-index: 1000; @if (session('message')['status']) background: #037720; @else background: #be0808; @endif">
            {{ session('message')['content'] }}
        </div>
    @endif


    @yield('content')


    <div class="footer">
        <div class="container-fluid pd-50">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-5">
                    <div class="footer_logo_content">
                        <div class="footer_logo">
                            <img style="max-width: 100px;"
                                src="{{ $app && $app->logo ? asset($app->logo) : asset('site/assets/images/logo.svg') }}"
                                alt="">
                        </div>
                        <div class="footer_conten">
                            {{ $app && $app->slogan ? $app->slogan : '' }}
                        </div>
                    </div>
                </div>
                <div class="col col-md-4 col-lg-2">
                    <div class="footer_links">
                        <h5>لينكات سريعة</h5>
                        <ul class="list-unstyled mb-0">
                            <li><a href="{{ route('site.home') }}">الرئيسية</a></li>
                            <li><a href="{{ route('site.aboutus.index') }}">من نحن </a></li>
                            <li><a href="{{ route('site.universites.index') }}">الجامعات</a></li>
                            <li><a href="{{ route('site.usedbooks.index') }}">الكتب المستعملة </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-md-4 col-lg-2">
                    <div class="footer_links">
                        <h5>الدعم</h5>
                        <ul class="list-unstyled mb-0">
                            <li><a href="{{ route('site.terms.index') }}">الشروط و الاحكام</a></li>
                            <li><a href="{{ route('site.contacts.index') }}">اتصل بنا </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="footer_follow">
                        <h5 class="text-center">تابعنا عبر وسائل التواصل الاجتماعي</h5>
                        <ul class="list-unstyled d-flex align-items-center text-center justify-content-center">
                            @if ($app && $app->facebook)
                                <li>
                                    <a href="{{ $app->facebook }}" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a>
                                </li>
                            @endif
                            @if ($app && $app->instagram)
                                <li>
                                    <a href="{{ $app->instagram }}" target="_blank"><i
                                            class="fab fa-instagram"></i></a>
                                </li>
                            @endif
                            @if ($app && $app->twitter)
                                <li>
                                    <a href="{{ $app->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                </li>
                            @endif
                            @if ($app && $app->google)
                                <li>
                                    <a href="{{ $app->google }}" target="_blank"><i
                                            class="fab fa-google-plus-g"></i></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('site/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/wow.js') }}"></script>
    <script src="{{ asset('site/assets/js/aos.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="{{ asset('site/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/jquery.mCustomScrollbar.js') }}"></script>
    <script src="{{ asset('site/assets/js/jquery.nice-select.min.js') }}"></script>
    <!-- for menue in mobile -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/9.3.0/mmenu.min.js"
        integrity="sha512-l2fHTYCLVbhRDc5CZWrkKJ06JWFjG5etNQ4G85PbyRiHP769IiVDmhwI0BYSFOXYJUYRmaq5PvfaxacZm9eqhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('site/assets/js/audioplayer.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.1.3/iscroll.min.js"></script>
    <script src="{{ asset('site/assets/js/main.js') }}"></script>

    <script>
        // JavaScript code to hide the notification after 5 seconds
        setTimeout(function() {
            var notification = document.getElementById('notification');
            notification.style.display = 'none';
        }, 5000); // Adjust the time as per your requirement
    </script>

    @yield('js')
</body>

</html>
