<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="mdi mdi-menu mdi-24px"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Language -->
            <li class=" me-1 me-xl-0">
                <a onclick="$('#changeLangForm').submit()"
                    class="nav-link btn btn-text-secondary rounded-pill btn-icon hide-arrow" href="javascript:void(0);">
                    <i class="mdi mdi-translate mdi-24px"></i>
                </a>

                <form method="POST" action="{{ route('site.lang.update') }}" class="d-none" id="changeLangForm">
                    @csrf
                    @if (app()->getLocale() == 'ar')
                        <input type="hidden" name="lang" value="en">
                    @else
                        <input type="hidden" name="lang" value="ar">
                    @endif
                </form>

            </li>
            <!--/ Language -->

            <!-- Style Switcher -->
            <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                    href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="mdi mdi-24px"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                            <span class="align-middle"><i class="mdi mdi-weather-sunny me-2"></i>{{ __('Light') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                            <span class="align-middle"><i class="mdi mdi-weather-night me-2"></i>{{ __('Dark') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                            <span class="align-middle"><i class="mdi mdi-monitor me-2"></i>{{ __("System") }}</span>
                        </a>
                    </li>
                </ul>
                <!-- / Style Switcher-->

                <!-- Quick links  -->
            </li>

            <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-1 me-xl-0">
                <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                    href="{{ route('site.home') }}" target="_blank">
                    <i class="mdi mdi-web mdi-24px"></i>
                </a>

            </li>
            <!-- Quick links -->

            <!-- Notification -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-2 me-xl-1">
                <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow show-notifications-btn"
                    href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                    aria-expanded="false">
                    <i class="mdi mdi-bell-outline mdi-24px"></i>
                    <div class="notification-alarm">
                        @include('dashboard.partials.__notifications_alarm')
                    </div>

                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0">
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h6 class="mb-0 me-auto">{{ __('Notifications') }}</h6>
                            <div class="notification-counter">

                                @include('dashboard.partials.__notifications_counter')
                            </div>
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                            @foreach (auth()->user()->notifications as $notification)
                                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                    <div class="d-flex gap-2">
                                        <div class="flex-shrink-0">
                                            <div class="avatar me-1">
                                                <img src="{{ asset('dashboard/assets/img/avatars/1.png') }}" alt
                                                    class="w-px-40 h-auto rounded-circle" />
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1 overflow-hidden w-px-200">
                                            <h6 class="mb-1 text-truncate">
                                                {{ Str::upper($notification->data['title']) }}</h6>
                                            <small
                                                class="text-truncate text-body">{{ $notification->data['body'] }}</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <small
                                                class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </li>
                    <li class="dropdown-menu-footer border-top p-2">
                        <a href="{{ route('notifications.index') }}"
                            class="btn btn-primary d-flex justify-content-center">
                            {{ __('View all notifications') }}
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ Notification -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ auth()->user()->avatar ? asset(auth()->user()->avatar) : asset('dashboard/assets/img/avatars/1.png') }}"
                            alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ auth()->user()->avatar ? asset(auth()->user()->avatar) : asset('dashboard/assets/img/avatars/1.png') }}"
                                            alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-medium d-block">{{ auth()->user()->name }}</span>
                                    <small class="text-muted">{{ auth()->user()->roles->first()->name }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('settings.index') }}">
                            <i class="mdi mdi-cog-outline me-2"></i>
                            <span class="align-middle">{{ __("Settings") }}</span>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" onclick="$('#logoutForm').submit()">
                            <i class="mdi mdi-logout me-2"></i>
                            <span class="align-middle">{{ __("Log Out") }}</span>
                        </a>

                        <form id="logoutForm" class="d-none" action="{{ route('dashboard.logout') }}"
                            method="POST">@csrf</form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
<!-- / Navbar -->
