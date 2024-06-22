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


    <div class="position_header position_header_relative">
        <div class="top_header">
            <div class="container-fluid pd-50">
                <div class="wrap">
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="top_header_contact">
                                <ul class="list-unstyled d-flex align-items-center justify-content-start">
                                    <li><a href="mailto:salasleldwagn@gmail.com"><i
                                                class="fas fa-envelope"></i><span>salasleldwagn@gmail.com</span></a>
                                    </li>
                                    <li><a href="tel:96605777216"><i class="fas fa-phone-alt"></i><span>966
                                                05777216</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="top_header_social">
                                <ul class="list-unstyled d-flex align-items-center justify-content-end">
                                    <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fab fa-instagram"></i></a></li>
                                    <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="custom_navbar">
            <div class="container-fluid pd-50">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-8 col-lg-9">
                        <div class="logo_links d-flex align-items-center">
                            <a class="menu" href="#menu">
                                <i class="fas fa-bars"></i>
                            </a>
                            <a href="./index.html" class="logo">
                                <img src="site/assets/images/logo.svg" alt="">
                            </a>
                            <div class="links">
                                <ul class="list-unstyled d-flex align-items-center">
                                    <li><a href="">الرئيسية</a></li>
                                    <li><a href="">من نحن </a></li>
                                    <li><a href="">الجامعات</a></li>
                                    <li><a href="">الكتب المستعملة </a></li>
                                    <li><a href="">العروض والخصومات</a></li>
                                    <li><a href="">اتصل بنا</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-3">
                        <div class="options">
                            <ul class="list-unstyled d-flex align-items-center justify-content-end">
                                <li><a href=""><img src="site/assets/images/comment.svg" alt=""></a>
                                </li>
                                <li><a href=""><img src="site/assets/images/bill.svg" alt=""></a></li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="site/assets/images/user.svg" alt="">
                                        </button>
                                        <ul class="dropdown-menu">
                                            @auth
                                                <li><a class="dropdown-item" href="#">حسابي</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="$('#logoutForm').submit()">تسجيل الخروج</a></li>
                                                <form id="logoutForm" class="d-none" action="{{ route("site.logout") }}" method="post">
                                                    @csrf

                                                </form>
                                            @else
                                                <li><a class="dropdown-item" href="#">تسجيل الدخول</a></li>
                                                <li><a class="dropdown-item" href="#">انشاء حساب جديد</a></li>
                                            @endauth
                                        </ul>
                                    </div>
                                </li>
                                <li><a href=""><span class="number">9</span><img
                                            src="site/assets/images/cart.svg" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @yield('content')


    <div class="footer">
        <div class="container-fluid pd-50">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-5">
                    <div class="footer_logo_content">
                        <div class="footer_logo">
                            <img src="site/assets/images/logo.svg" alt="">
                        </div>
                        <div class="footer_conten">
                            <p>“لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور
                                أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد
                                أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواس
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col col-md-4 col-lg-2">
                    <div class="footer_links">
                        <h5>لينكات سريعة</h5>
                        <ul class="list-unstyled mb-0">
                            <li><a href="">الرئيسية</a></li>
                            <li><a href="">الأقسام الرئيسية</a></li>
                            <li><a href="">اتصل بنا</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-md-4 col-lg-2">
                    <div class="footer_links">
                        <h5>الدعم</h5>
                        <ul class="list-unstyled mb-0">
                            <li><a href="">الشروط و الاحكام</a></li>
                            <li><a href="">الاسئلة الشائعة</a></li>
                            <li><a href="">عن الموقع</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="footer_follow">
                        <h5 class="text-center">تابعنا عبر وسائل التواصل الاجتماعي</h5>
                        <ul class="list-unstyled d-flex align-items-center text-center justify-content-center">
                            <li>
                                <a href="" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="" target="_blank"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="" target="_blank"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="" target="_blank"><i class="fab fa-google-plus-g"></i></a>
                            </li>

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
</body>

</html>
