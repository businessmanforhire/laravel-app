<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|s
*/



Auth::routes();

Route::get('/home', (['as'=>'home','uses'=>'HomeController@index','roles' => [1,2,3,4]]));
Route::get('/', (['as'=>'/','uses'=>'HomeController@index','roles' => [1,2,3,4]]));
Route::get('/dashboard', (['as'=>'dashboard','uses'=>'HomeController@dashboard','roles' => [5]]));


Route::prefix('admins')->group(function () {
    Route::get('index', (['as'=>'admin.index','uses'=>'UserController@index','roles' => [1,2,3,4]]));
    Route::post('store', (['as'=>'admin.store','uses'=>'UserController@store','roles' => [1,2]]));
    Route::get('delete/{id}', (['as'=>'admin.delete','uses'=>'UserController@destroy','roles' => [1,2]]));
    Route::post('update/{id}', (['as'=>'admin.update','uses'=>'UserController@update','roles' => [1,2]]));
    Route::get('admin_edit_profile',(['as'=>'admin_edit_profile','uses'=>'UserController@admin_edit_profile','roles' => [1,2,3,4,5]]));
    Route::post('submit_admin_edit_profile',(['as'=>'submit_admin_edit_profile','uses'=>'UserController@submit_admin_edit_profile','roles' => [1,2,]]));
    Route::post('admin_change_password',(['as'=>'admin_change_password','uses'=>'UserController@change_password','roles' => [1,2]]));
});



Route::prefix('business')->group(function () {
    Route::get('index', (['as'=>'business.index','uses'=>'BusinessInfoController@index','roles' => [1,2,3,4]]));
    Route::get('create', (['as'=>'business.create','uses'=>'BusinessInfoController@create','roles' => [1,2,3,4]]));
    Route::post('store', (['as'=>'business.store','uses'=>'BusinessInfoController@store','roles' => [1,2,3,4]]));
    Route::get('edit/{id}', (['as'=>'business.edit','uses'=>'BusinessInfoController@edit','roles' => [1,2,3,4]]));
    Route::post('update/{id}', (['as'=>'business.update','uses'=>'BusinessInfoController@update','roles' => [1,2,3,4]]));
    Route::get('delete/{id}', (['as'=>'business.delete','uses'=>'BusinessInfoController@destroy','roles' => [1,2,3,4]]));
    Route::get('business_profile', (['as'=>'business.profile','uses'=>'BusinessInfoController@business_profile','roles' => [5]]));
    Route::get('edit_business_profile', (['as'=>'business.edit.profile','uses'=>'BusinessInfoController@edit_business_profile','roles' => [5]]));
    Route::post('update_business_profile/{id}', (['as'=>'business.update.profile','uses'=>'BusinessInfoController@update_business_profile','roles' => [5]]));
    Route::get('view_business_details/{id}', (['as'=>'view_business_details','uses'=>'BusinessInfoController@view_business_details','roles' => [1,2,3,4]]));

    Route::get('business_images', (['as'=>'business_images','uses'=>'BusinessInfoController@business_images','roles' => [5]]));
    Route::post('add_business_images', (['as'=>'add_business_images','uses'=>'BusinessInfoController@add_business_images','roles' => [5]]));
    Route::get('delete_business_image/{id}', (['as'=>'delete_business_image','uses'=>'BusinessInfoController@delete_business_image','roles' => [5]]));


});

Route::prefix('category')->group(function () {
    Route::get('index', (['as'=>'category.index','uses'=>'CategoryController@index','roles' => [1,2,3,4]]));
    Route::post('store', (['as'=>'category.store','uses'=>'CategoryController@store','roles' => [1,2,3,4]]));
    Route::post('update/{id}', (['as'=>'category.update','uses'=>'CategoryController@update','roles' => [1,2,3,4]]));
    Route::get('delete/{id}', (['as'=>'category.delete','uses'=>'CategoryController@destroy','roles' => [1,2,3,4]]));
    Route::post('importCategory/{id}', (['as'=>'category.import','uses'=>'CategoryController@importCategory','roles' => [1,2,3,4]]));
    Route::get('export_category_format', (['as' => 'export_category_format', 'uses' => 'CategoryController@export_category_format','roles' => [1,2,3,4]]));


});

Route::prefix('brand')->group(function () {
    Route::get('index', (['as'=>'brand.index','uses'=>'BrandController@index','roles' => [1,2,3,4]]));
    Route::post('store', (['as'=>'brand.store','uses'=>'BrandController@store','roles' => [1,2,3,4]]));
    Route::post('update/{id}', (['as'=>'brand.update','uses'=>'BrandController@update','roles' => [1,2,3,4]]));
    Route::get('delete/{id}', (['as'=>'brand.delete','uses'=>'BrandController@destroy','roles' => [1,2,3,4]]));


});

Route::prefix('products')->group(function () {
    Route::get('index', (['as'=>'product.index','uses'=>'ProductController@index','roles' => [5]]));
    Route::get('create', (['as'=>'product.create','uses'=>'ProductController@create','roles' => [5]]));
    Route::post('store', (['as'=>'product.store','uses'=>'ProductController@store','roles' => [5]]));
    Route::get('edit/{id}', (['as'=>'product.edit','uses'=>'ProductController@edit','roles' => [5]]));
    Route::post('update/{id}', (['as'=>'product.update','uses'=>'ProductController@update','roles' => [5]]));
    Route::get('delete/{id}', (['as'=>'product.delete','uses'=>'ProductController@destroy','roles' => [5]]));
    Route::get('export_products_format', (['as' => 'export_products_format', 'uses' => 'ProductController@export_products_format']));
    Route::post('importProduct', (['as'=>'product.import','uses'=>'ProductController@importProductExcel','roles' => [5]]));
    Route::get('product_images/{id}', (['as'=>'product_images','uses'=>'ProductController@product_images','roles' => [5]]));
    Route::get('delete_image/{id}', (['as'=>'delete_image','uses'=>'ProductController@delete_image','roles' => [5]]));

    Route::get('product_size/{id}', (['as'=>'product_size','uses'=>'ProductController@product_size','roles' => [5]]));
    Route::post('create_product_size/{id}', (['as'=>'create_product_size','uses'=>'ProductController@create_product_size','roles' => [5]]));
    Route::post('update_product_size/{id}', (['as'=>'update_product_size','uses'=>'ProductController@update_product_size','roles' => [5]]));

    Route::get('highlighted_businesses', (['as'=>'highlighted_businesses','uses'=>'BusinessInfoController@highlighted_businesses','roles' => [1,2,3,4]]));
    Route::post('add_highlighted_businesses', (['as'=>'add_highlighted_businesses','uses'=>'BusinessInfoController@add_highlighted_businesses','roles' => [1,2,3,4]]));
    Route::get('delete_highlighted_businesses/{id}', (['as'=>'delete_highlighted_businesses','uses'=>'BusinessInfoController@delete_highlighted_businesses','roles' => [1,2,3,4]]));



});

Route::prefix('business_category')->group(function () {
    Route::get('index', (['as'=>'business_category.index','uses'=>'BusinessCategoryController@index','roles' => [1,2,3,4]]));
    Route::post('store', (['as'=>'business_category.store','uses'=>'BusinessCategoryController@store','roles' => [1,2,3,4]]));
    Route::post('update/{id}', (['as'=>'business_category.update','uses'=>'BusinessCategoryController@update','roles' => [1,2,3,4]]));
    Route::get('delete/{id}', (['as'=>'business_category.delete','uses'=>'BusinessCategoryController@destroy','roles' => [1,2,3,4]]));
    Route::get('subcategory/{id}', (['as'=>'subcategory.index','uses'=>'CategoryController@show','roles' => [1,2,3,4]]));
    Route::post('store_subcategory/{id}', (['as'=>'subcategory.store','uses'=>'CategoryController@store_subcategory','roles' => [1,2,3,4]]));
});


Route::prefix('mobile_users')->group(function () {
    Route::get('index', (['as'=>'mobile_users.index','uses'=>'MobileUserController@index','roles' => [1,2,3,4]]));
    Route::post('store', (['as'=>'mobile_users.store','uses'=>'MobileUserController@store','roles' => [1,2]]));
    Route::get('delete/{id}', (['as'=>'mobile_users.delete','uses'=>'MobileUserController@destroy','roles' => [1,2]]));
    Route::post('update/{id}', (['as'=>'mobile_users.update','uses'=>'MobileUserController@update','roles' => [1,2]]));
    Route::get('order_history/{id}', (['as'=>'order_history','uses'=>'MobileUserController@show','roles' => [1,2,3,4]]));

});


Route::prefix('push')->group(function () {
    Route::get('index', (['as'=>'push.index','uses'=>'PushNotificationController@index','roles' => [1,2,3,4]]));
    Route::get('create', (['as'=>'push.create','uses'=>'PushNotificationController@create','roles' => [1,2,3,4]]));
    Route::get('show', (['as'=>'push.show','uses'=>'PushNotificationController@show','roles' => [1,2,3,4]]));
    Route::post('store_individual/{id}', (['as'=>'push.store_individual','uses'=>'PushNotificationController@store_individual','roles' => [1,2]]));
    Route::post('store_global', (['as'=>'push.store_global','uses'=>'PushNotificationController@store_global','roles' => [1,2]]));
    Route::post('store_individ', (['as'=>'push.store_individ','uses'=>'PushNotificationController@store_individ','roles' => [1,2]]));
});

Route::prefix('reviews')->group(function () {
    Route::get('index', (['as'=>'review.index','uses'=>'ReviewController@index','roles' => [5]]));
    Route::get('product_review', (['as'=>'review.product_review','uses'=>'ProductController@product_review','roles' => [5]]));
});

Route::prefix('coupon_type')->group(function () {
    Route::get('index', (['as'=>'coupon_type.index','uses'=>'CouponController@show','roles' => [1,2,3,4]]));
    Route::post('store', (['as'=>'coupon_type.store','uses'=>'CouponController@store_coupon_type','roles' => [1,2,3,4]]));
    Route::post('update/{id}', (['as'=>'coupon_type.update','uses'=>'CouponController@update_coupon_type','roles' => [1,2,3,4]]));
    Route::get('delete/{id}', (['as'=>'coupon_type.delete','uses'=>'CouponController@delete_coupon_type','roles' => [1,2,3,4]]));

});

Route::prefix('coupons')->group(function () {
    Route::get('index', (['as'=>'coupon.index','uses'=>'CouponController@index','roles' => [5]]));
    Route::get('create', (['as'=>'coupon.create','uses'=>'CouponController@create','roles' => [5]]));
    Route::post('store', (['as'=>'coupon.store','uses'=>'CouponController@store','roles' => [5]]));
});

Route::prefix('configurations')->group(function () {
    Route::get('privacy_policy', (['as'=>'privacy_policy','uses'=>'ConfigurationController@privacy_policy','roles' => [1,2,3,4]]));
    Route::post('submit_privacy_policy', (['as'=>'submit_privacy_policy','uses'=>'ConfigurationController@submit_privacy_policy','roles' => [1,2,3,4]]));

});

Route::get('update_notification_counter',(['as'=>'update_notification_counter','uses'=>'HomeController@update_notification_counter','roles' => [5]]));
Route::get('orders_notification',(['as'=>'orders_notification','uses'=>'HomeController@orders_notification','roles' => [5]]));

Route::get('update_review_counter',(['as'=>'update_review_counter','uses'=>'HomeController@review_notification_counter','roles' => [5]]));
Route::get('review_notification',(['as'=>'review_notification','uses'=>'HomeController@review_notification','roles' => [5]]));


Route::prefix('orders')->group(function () {
    Route::get('index', (['as'=>'orders.index','uses'=>'OrderController@index','roles' => [5]]));
    Route::get('managed_orders', (['as'=>'orders.managed_orders','uses'=>'OrderController@managed_orders','roles' => [5]]));
    Route::get('change_status/{id}/{status}', (['as'=>'orders.change_status','uses'=>'OrderController@change_status','roles' => [5]]));
    Route::get('order_details/{id}', (['as'=>'order_details','uses'=>'OrderController@order_details','roles' => [1,2,3,4,5]]));
});

Route::post('order_datatable', (['as'=>'order_datatable','uses'=>'OrderController@order_datatable','roles' => [5]]));
Route::post('product_datatable', (['as'=>'product_datatable','uses'=>'ProductController@product_datatable','roles' => [5]]));

Route::prefix('banners')->group(function () {
    Route::get('index', (['as'=>'banner.index','uses'=>'BannerController@index','roles' => [1,2,3,4]]));
    Route::post('store', (['as'=>'banner.store','uses'=>'BannerController@store','roles' => [1,2,3,4]]));
    Route::post('update/{id}', (['as'=>'banner.update','uses'=>'BannerController@update','roles' => [1,2,3,4]]));
    Route::get('delete/{id}', (['as'=>'banner.delete','uses'=>'BannerController@destroy','roles' => [1,2,3,4]]));
});

Route::prefix('subscription')->group(function () {
    Route::get('index', (['as'=>'subscription.index','uses'=>'SubscriptionController@index','roles' => [1,2,3,4]]));
    Route::get('create', (['as'=>'subscription.create','uses'=>'SubscriptionController@create','roles' => [1,2,3,4]]));
    Route::post('store', (['as'=>'subscription.store','uses'=>'SubscriptionController@store','roles' => [1,2,3,4]]));
    Route::get('edit/{id}', (['as'=>'subscription.edit','uses'=>'SubscriptionController@edit','roles' => [1,2,3,4]]));
    Route::post('update/{id}', (['as'=>'subscription.update','uses'=>'SubscriptionController@update','roles' => [1,2,3,4]]));
    Route::get('delete/{id}', (['as'=>'subscription.delete','uses'=>'SubscriptionController@destroy','roles' => [1,2,3,4]]));
    Route::get('view_subscribers/{id}', (['as'=>'view_subscribers','uses'=>'SubscriptionController@view_subscribers','roles' => [1,2,3,4]]));
    Route::post('add_subscriber/{sub_id}', (['as'=>'add_subscriber','uses'=>'SubscriptionController@add_subscriber','roles' => [1,2,3,4]]));
    Route::post('update_subscriber/{sub_id}/{id}', (['as'=>'update_subscriber','uses'=>'SubscriptionController@update_subscriber','roles' => [1,2,3,4]]));

});

Route::prefix('subscription_time')->group(function () {
Route::get('index', (['as'=>'subscription_time.index','uses'=>'SubscriptionTimeController@index','roles' => [1,2,3,4]]));
Route::post('store', (['as'=>'subscription_time.store','uses'=>'SubscriptionTimeController@store','roles' => [1,2,3,4]]));
Route::post('update/{id}', (['as'=>'subscription_time.update','uses'=>'SubscriptionTimeController@update','roles' => [1,2,3,4]]));
Route::get('delete/{id}', (['as'=>'subscription_time.delete','uses'=>'SubscriptionTimeController@destroy','roles' => [1,2,3,4]]));


});