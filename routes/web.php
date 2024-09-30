<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Livewire\Frontend\PaymentRequest;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();



Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function(){
    Route::get('/','index');
    Route::get('/collections','categories')->name('categories');
    Route::get('/collections/{category_slug}','products')->name('products');
    Route::get('/collections/{category_slug}/{product_slug}','productView')->name('productView');
    Route::get('/new-arrivals','newArrivals');
    Route::get('/featured-products','featuredProducts');
    Route::get('/search','searchProducts');

   
});



Route::middleware(['auth'])->group(function (){

    Route::get('wishlist',[App\Http\Controllers\Frontend\WishlistController::class,'index']);
    Route::get('cart',[App\Http\Controllers\Frontend\CartController::class,'index']);
    Route::get('checkout',[App\Http\Controllers\Frontend\CheckoutController::class,'index']);

    Route::get('orders',[App\Http\Controllers\Frontend\OrderController::class,'index']);
    Route::get('orders/{orderId}',[App\Http\Controllers\Frontend\OrderController::class,'show']);




});
 Route::get('thank-you',[App\Http\Controllers\Frontend\FrontendController::class,'thankyou']);
 Route::get('payment-request',App\Livewire\Frontend\PaymentRequest::class);
 Route::get('request-list',App\Livewire\Frontend\RequestList::class);
 Route::get('payment-request-details',App\Livewire\Frontend\PaymentRequestDetails::class);






Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class,'index']);

    // livewire component routes for category
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function (){
        Route::get('/category','index');
        Route::get('/category/create','create');
        Route::post('/category','store');// beacause data is stored in index page
        Route::get('/category/{category}/edit','edit'); 
        Route::put('/category/{category}','update');
    });

    // product routes
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function(){
        Route::get('/products','index');
        Route::get('/products/create','create');
        Route::post('/products','store');
        Route::get('/products/{product}/edit','edit');
        Route::put('/products/{product}','update');
        Route::get('/products/{product_id}/delete','destroy');
        Route::get('/product-image/{product_image_id}/delete','destroyImage');

        Route::post('/product-color/{prod_color_id}','updateProdColorQty');
        Route::get('/product-color/{prod_color_id}/delete','deleteProdColor');


    });

    // brand routes
    Route::get('/brand',App\Livewire\Admin\Brand\Index::class,'index');
    // Route::get('/brand/create',App\Livewire\Admin\Brand\Index::class,'index'); //index because it is in modal

    // color routes
    Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function(){
        Route::get('/colors','index');
        Route::get('/colors/create','create');
        Route::post('/colors/create','store');
        Route::get('/colors/{color}/edit','edit');
        Route::put('/colors/{color_id}','update');
        Route::get('/colors/{color_id}/delete','destroy');
    });

    // slider routes
    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function(){
        Route::get('/slider','index');
        Route::get('/slider/create','create');
        Route::post('/slider/create','store');
        Route::get('/slider/{slider}/edit','edit');
        Route::put('/slider/{slider}','update');
        Route::get('/slider/{slider}/delete','destroy');

    });

    // admin/orders
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function(){
        Route::get('/orders','index');
        Route::get('/orders/{orderId}','show');
        Route::put('/orders/{orderId}','updateOrderStatus');

        //invoice getting pdf download and view
        Route::get('/invoice/{orderId}','viewInvoice');
        Route::get('/invoice/{orderId}/generate','generateInvoice');


    });

    // for user edit update delete
    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function(){
        Route::get('/users','index');
        Route::get('/users/create','create');
        Route::post('/users','store');
        Route::get('users/{user_id}/edit','edit');
        Route::put('users/{user_id}','update');
        Route::get('users/{user_id}/delete','destroy');

    });

});