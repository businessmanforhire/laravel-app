<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('register', 'API\AuthCustomController@register');
Route::post('login', 'API\AuthCustomController@login');
Route::post('send_code', 'API\AuthCustomController@send_code')->name('send_code');
Route::post('verify_code', 'API\AuthCustomController@verify_code')->name('verify_code');


Route::middleware('auth:api')->group(function () {

//    Route::post('send_code', 'API\AuthCustomController@send_code')->name('send_code');
//    Route::post('verify_code', 'API\AuthCustomController@verify_code')->name('verify_code');

    /******************* Business and Categories  **********/

    Route::get("business_categories","API\CategoryController@index");  //Shows all categories
    Route::post("choose_categories","API\CategoryController@choose_categories");  //Choose category
    Route::get("favourite_categories","API\CategoryController@get_favourite_categories"); //get all chosen categories
    Route::delete("favourite_categories/{id}","API\CategoryController@delete_favourite_category"); //delete a chosen categories

    Route::get("businesses_by_category/{id}","API\CategoryController@show");  //shows all businesses of a specific category
    Route::get("business_details/{id}","API\BusinessController@index");

    Route::post("review/{id}","API\BusinessController@leave_review");  //Leave Review
    Route::post("product_review/{id}","API\ProductController@product_review");  //Leave product Review


    /******************* PRODUCTS  *************************/

    Route::get("products/{id}","API\ProductController@index");
    Route::get("product_details/{id}","API\ProductController@show");

    Route::get("brands","API\ProductController@brands");
    Route::get("products_by_brand/{id}","API\ProductController@products_by_brand");


    /******************* Favourite Products  *************************/

    Route::get("favourite_product","API\ProductController@get_favourite_product");
    Route::post("favourite_product","API\ProductController@store_favourite_product");
    Route::delete("favourite_product/{id}","API\ProductController@delete_favourite_product");

    /******************* Favourite Businesses  *************************/
    Route::get("favourite_business","API\BusinessController@get_favourite_business");
    Route::post("favourite_business","API\BusinessController@store_favourite_business");
    Route::delete("favourite_business/{id}","API\BusinessController@delete_favourite_business");



    /******************* HOMEPAGE  *************************/
    Route::get("home","API\HomeController@index");
    Route::post("all_products","API\HomeController@all_products");
    Route::get("privacy_policy","API\HomeController@privacy_policy");
    Route::get("coupons","API\HomeController@coupons");



    /******************* USER  **************************/

    Route::get("profile","API\MobileUserController@index");
    Route::post("profile","API\MobileUserController@update");

    /******************* ADDRESS  ***********************/

    Route::get("address","API\AddressController@index");
    Route::post("address","API\AddressController@store");
    Route::put("address/{id}","API\AddressController@update");
    Route::delete("address/{id}","API\AddressController@delete_address");

    /******************* ORDER  *************************/
    Route::post("check_coupon","API\OrderController@check_coupon");

    Route::post("make_order","API\OrderController@make_order");
    Route::get("order_history","API\OrderController@order_history");
    Route::get("cancel_order/{id}","API\OrderController@cancel_order");

   //Shopping cart items in web API
    Route::post("order_shopping_cart","API\CartOrderItemController@order_shopping_cart");
    Route::get("order_item_cart","API\CartOrderItemController@order_item_cart");
    Route::get("order_details/{id}","API\CartOrderItemController@order_details");
    Route::delete("remove_item/{id}","API\CartOrderItemController@remove_item");
    Route::put("increase/{id}","API\CartOrderItemController@increase");
    Route::put("decrease/{id}","API\CartOrderItemController@decrease");
    Route::delete("remove_all","API\CartOrderItemController@remove_all");  //removing  items after checkout successfully

    /******************* Search  *************************/
    Route::post("global_search","API\HomeController@global_search");



});
