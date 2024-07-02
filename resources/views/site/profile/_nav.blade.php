<div class="col-sm-12 col-md-12 col-lg-3">
    <div class="profile-sidebar">
        <div class="close-sidebar">
            <i class="fas fa-times"></i>
        </div>
        <div class="profile-picture">
            <div class="card-img">
                <div class="img-parent">
                    <img src="{{ $user->avatar ? asset($user->avatar) : asset('site/assets/images/person.png') }}"
                        alt="">
                </div>
            </div>
        </div>
        <ul class="side-list list-unstyled">
            <li>
                <a class="{{ isActiveRoute('site.profile.index') }}" href="{{ route('site.profile.index') }}">
                    <i class="fas fa-user-circle"></i>
                    <span>البروفايل الشخصي</span>
                </a>
            </li>
            <li><a class="{{ isActiveRoute('site.favourite.index') }}" href="{{ route('site.favourite.index') }}"><i
                        class="fas fas fa-shopping-cart"></i><span>{{ __('Favourites') }}</span></a></li>
            <li><a class="{{ isActiveRoute('site.orders.index') }}" href="{{ route('site.orders.index') }}"><i
                        class="fas fas fa-shopping-cart"></i><span>{{ __('Orders') }}</span></a></li>
            <li><a class="{{ isActiveRoute('site.settings.index') }}" href="{{ route('site.settings.index') }}"><i
                        class="fas fas fa-cog"></i><span>الاعدادات</span></a>
            </li>
        </ul>
    </div>
</div>
