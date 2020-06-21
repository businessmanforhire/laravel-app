<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @if(Auth::user()->role!=\App\User::business)
            <li @if((\Route::currentRouteName() == '/')) class="active" @endif><a href="{{route('/')}}"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce Dashboard">Dashboard</span></a></li>

            @if(Auth::user()->role==\App\User::admin)
            <li @if((\Route::currentRouteName() == 'admin.index')) class="active" @endif  ><a href="{{ route('admin.index') }}"><i class="ft-users"></i><span class="menu-title" data-i18n="Shop">System Users</span></a></li>
            <li @if((\Route::currentRouteName() == 'mobile_users.index') or (\Route::currentRouteName() == 'order_history') ) class="active" @endif  ><a href="{{ route('mobile_users.index') }}"><i class="ft-users"></i><span class="menu-title" data-i18n="Shop">Mobile Users</span></a></li>
            <li class=" navigation-header"><span data-i18n="User Interface">Managment</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="User Interface"></i></li>
            <li class=" nav-item"><a href="#"><i class="ft-grid"></i><span class="menu-title" data-i18n="Form Layouts">Categories</span></a>
                    <ul class="menu-content">
                        <li @if(\Route::currentRouteName() == 'business_category.index' or  \Route::currentRouteName() == 'subcategory.index' )class="active" @else @endif><a class="menu-item" href="{{route('business_category.index')}}"><i></i><span data-i18n="Basic Forms">Business Categories</span></a></li>
                        <li @if((\Route::currentRouteName() == 'category.index')) class="active "  @else  @endif ><a href="{{route('category.index')}}"><i></i><span data-i18n="Horizontal Forms">All Categories</span></a>
                        </li>
                    </ul>
            </li>
            <li @if((\Route::currentRouteName() == 'business.index') or  (\Route::currentRouteName() == 'business.create') or (\Route::currentRouteName() == 'business.edit') or (\Route::currentRouteName() == 'view_business_details') ) class="active" @endif  ><a href="{{route('business.index')}}"><i class="la la-users"></i><span class="menu-title" data-i18n="Product Detail">Business Users</span></a></li>@endif

            <li class=" navigation-header"><span data-i18n="User Interface">Push Notification</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="User Interface"></i></li>
                <li class=" nav-item"><a href="#"><i class="la la-bell"></i><span class="menu-title" data-i18n="Form Layouts">Push</span></a>
                <ul class="menu-content">
                    <li @if(\Route::currentRouteName() == 'push.index' )class="active" @else @endif><a class="menu-item" href="{{route('push.index')}}"><i></i><span data-i18n="Basic Forms">Push List</span></a></li>
                    <li @if((\Route::currentRouteName() == 'push.create')) class="active "  @else  @endif ><a href="{{route('push.create')}}"><i></i><span data-i18n="Horizontal Forms">Push Global</span></a></li>
                    <li @if((\Route::currentRouteName() == 'push.show')) class="active "  @else  @endif ><a href="{{route('push.show')}}"><i></i><span data-i18n="Horizontal Forms">Push Individual</span></a></li>
                </ul>
            </li>

                <li class=" navigation-header"><span data-i18n="User Interface">Subscription Managment</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="User Interface"></i></li>
                <li @if((\Route::currentRouteName() == 'subscription_time.index')) class="active" @endif  ><a href="{{ route('subscription_time.index') }}"><i class="ft-clock"></i><span class="menu-title" data-i18n="Shop">Subscription Time</span></a></li>
                <li @if((\Route::currentRouteName() == 'subscription.index') or (\Route::currentRouteName() == 'subscription.create')or (\Route::currentRouteName() == 'subscription.edit')) class="active" @endif  ><a href="{{ route('subscription.index') }}"><i class="ft-server"></i><span class="menu-title" data-i18n="Shop">Subscriptions</span></a></li>


                <li class=" navigation-header"><span data-i18n="User Interface">Configurations</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="User Interface"></i></li>
                <li @if((\Route::currentRouteName() == 'banner.index')) class="active" @endif  ><a href="{{ route('banner.index') }}"><i class="ft-image"></i><span class="menu-title" data-i18n="Shop">Banner</span></a></li>
                <li @if((\Route::currentRouteName() == 'highlighted_businesses')) class="active" @endif  ><a href="{{ route('highlighted_businesses') }}"><i class="ft-layers"></i><span class="menu-title" data-i18n="Shop">Highlighted Businesses</span></a></li>
                <li @if((\Route::currentRouteName() == 'brand.index')) class="active" @endif  ><a href="{{ route('brand.index') }}"><i class="ft-image"></i><span class="menu-title" data-i18n="Shop">Brand</span></a></li>
                <li @if((\Route::currentRouteName() == 'privacy_policy')) class="active" @endif  ><a href="{{ route('privacy_policy') }}"><i class="ft-clipboard"></i><span class="menu-title" data-i18n="Shop">Privacy Policy</span></a></li>
                <li @if((\Route::currentRouteName() == 'coupon_type.index')) class="active" @endif  ><a href="{{ route('coupon_type.index') }}"><i class="ft-percent"></i><span class="menu-title" data-i18n="Shop">Coupon Types</span></a></li>

            @endif

        @if(Auth::user()->role==\App\User::business)

                    <li @if((\Route::currentRouteName() == 'dashboard')) class="active" @endif><a href="{{route('dashboard')}}"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce Dashboard">Dashboard</span></a></li>

                    <li class=" navigation-header"><span data-i18n="User Interface">Info</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="User Interface"></i></li>
                    <li @if((\Route::currentRouteName() == 'business.profile') or \Route::currentRouteName() == 'business.edit.profile')) class="active" @endif><a href="{{route('business.profile')}}"><i class="la la-building"></i><span class="menu-title" >My Business Profile</span></a></li>
                    <li @if((\Route::currentRouteName() == 'product.index') or (\Route::currentRouteName() == 'product.add') or (\Route::currentRouteName() == 'product.edit') or  (\Route::currentRouteName() == 'product_images')) class="active" @endif><a href="{{route('product.index')}}"><i class="ft-grid"></i><span class="menu-title" >Products</span></a></li>


                    @if( \App\BusinessSubscription::subscription()->exists())
                    <li class=" navigation-header"><span data-i18n="User Interface">Orders</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="User Interface"></i></li>
                    <li @if((\Route::currentRouteName() == 'orders.index')) class="active" @endif><a href="{{route('orders.index')}}"><i class="la la-list"></i><span class="menu-title" >Incoming Orders</span></a></li>
                    <li @if((\Route::currentRouteName() == 'orders.managed_orders')) class="active" @endif><a href="{{route('orders.managed_orders')}}"><i class="la la-list-alt"></i><span class="menu-title" >Managed Orders</span></a></li>
                    @endif

                    @if( \App\BusinessSubscription::where('subscription_id',\App\Subscription::diamond)->subscription()->exists())
                        <li class=" navigation-header"><span data-i18n="User Interface">Configurations</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="User Interface"></i></li>
                        <li @if((\Route::currentRouteName() == 'coupon.index') or (\Route::currentRouteName() == 'coupon.create') ) class="active" @endif  ><a href="{{ route('coupon.index') }}"><i class=" ft ft-percent"></i><span class="menu-title" data-i18n="Shop">Coupons</span></a></li>
                    @endif
                    <li class=" navigation-header"><span data-i18n="User Interface">Other</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="User Interface"></i></li>
                    <li @if((\Route::currentRouteName() == 'review.index')) class="active" @endif><a href="{{route('review.index')}}"><i class="ft ft-star"></i><span class="menu-title" >Reviews</span></a></li>
                    <li @if((\Route::currentRouteName() == 'review.product_review')) class="active" @endif><a href="{{route('review.product_review')}}"><i class="ft ft-star"></i><span class="menu-title" >Product Review</span></a></li>

        @endif
        </ul>
    </div>
</div>


