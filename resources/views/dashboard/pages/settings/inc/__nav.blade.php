<div class="col-xl-3 col-lg-4 col-md-4 mb-lg-0 mb-4">
    <h4>Settings</h4>
    <div class="nav-align-left">
        <ul class="nav nav-pills border-0 w-100 gap-1">
            <li class="nav-item">
                <a href="{{ route('settings.index') }}" class="nav-link {{ isActiveRoute('settings.index') }}">{{ __("General") }}</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('banks.index') }}" class="nav-link {{ isActiveRoute('banks.index') }}">{{ __('Bank Settings') }}</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('shippings.index') }}" class="nav-link {{ isActiveRoute('shippings.index') }}">{{ __("Delivery Settings") }}</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('sliders.index') }}" class="nav-link {{ isActiveRoute('sliders.index') }}">{{ __("Header Images") }}</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pages.index') }}" class="nav-link {{ isActiveRoute('pages.index') }}">{{ __("Pages") }}</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('aboutus.index') }}" class="nav-link {{ isActiveRoute('aboutus.index') }}">{{ __("About US") }}</a>
            </li>
        </ul>
    </div>
</div>
