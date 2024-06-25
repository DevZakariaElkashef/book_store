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
                                <li><a href="{{ route('site.home') }}">الرئيسية</a></li>
                                <li><a href="{{ route('site.aboutus.index') }}">من نحن </a></li>
                                <li><a href="{{ route('site.universites.index') }}">الجامعات</a></li>
                                <li><a href="{{ route('site.usedbooks.index') }}">الكتب المستعملة </a></li>
                                <li><a href="{{ route('site.books.offers') }}">العروض والخصومات</a></li>
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
                                            <li><a class="dropdown-item" href="#"
                                                    onclick="$('#logoutForm').submit()">تسجيل الخروج</a></li>
                                            <form id="logoutForm" class="d-none" action="{{ route('site.logout') }}"
                                                method="post">
                                                @csrf

                                            </form>
                                        @else
                                            <li><a class="dropdown-item" href="{{ route('site.login_page') }}">تسجيل
                                                    الدخول</a></li>
                                            <li><a class="dropdown-item" href="{{ route('site.register_page') }}">انشاء حساب
                                                    جديد</a></li>
                                        @endauth
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="">
                                    @if (auth()->check() && auth()->user()->cart)
                                        <span class="number">
                                            {{ auth()->user()->cart->items->count() }}
                                        </span>
                                    @endif
                                    <img src="site/assets/images/cart.svg" alt="">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
