<?php

use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CounponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OnlinePaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckAdminMiddleware;
use Illuminate\Support\Facades\Route;

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

Route::view('admin', function(){
    return 'Đây là Admin';
})->middleware(CheckAdminMiddleware::class);

// $sliders = \App\Models\slider::query()->latest('id')->where('status', '=', 1)->get();

Route::get('/', function () {
    $products = \App\Models\Product::query()->latest('id')->limit(4)->get();
    $sliders = \App\Models\slider::query()->latest('id')->where('status', '=', 1)->get();
    // dd($sliders);
    return view('welcome', compact('products', 'sliders'));
})->name('welcome')->middleware(['isMember']);

// Route::resource('categories',           CategoryController::class);

// Auth::routes();

Route::get('auth/login',                    [LoginController::class, 'showFormLogin'])->name('login');
Route::post('auth/login',                   [LoginController::class, 'login']);
Route::post('auth/logout',                  [LoginController::class, 'logout'])->name('logout');

Route::get('auth/register',                 [RegisterController::class, 'showFormRegister'])->name('register');
Route::post('auth/register',                [RegisterController::class, 'register']);

Route::get('/home',                         [HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}',               [ProductController::class, 'detail'])->name('product.detail');
Route::get('/thankyou',                     [HomeController::class, 'thankyou'])->name('thankyou');

//Counpon 
Route::get('counpon',                     [CounponController::class, 'index'])->name('counpon');


//Mau bán hàng 
Route::get('cart/list',                 [CartController::class, 'list'])->name('cart.list');
Route::post('cart/add',                 [CartController::class, 'add'])->name('cart.add');
Route::get('cart/delete/{id}',          [CartController::class, 'delete'])->name('cart.delete');
Route::get('cart/addCoupon',            [CartController::class, 'addCoupon'])->name('cart.addcoupon');
Route::post('onlinepayment',            [OnlinePaymentController::class, 'vnpay_payment'])->name('onlinepayment');


Route::post('order/save',               [OrderController::class, 'save'])->name('order.save');

// Test
Route::get('send-mail',                 [MailController::class, 'index'])->name('sendMail');




