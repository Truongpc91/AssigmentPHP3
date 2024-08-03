<?php

use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\CatalogueController;
// use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::prefix('catalogues')
            ->as('catalogues.')
            ->group(function () {
                Route::get('/',                 [CatalogueController::class, 'index'])->name('index');
                Route::get('create',            [CatalogueController::class, 'create'])->name('create');
                Route::post('store',            [CatalogueController::class, 'store'])->name('store');
                Route::get('show/{id}',         [CatalogueController::class, 'show'])->name('show');
                Route::get('{id}/edit',         [CatalogueController::class, 'edit'])->name('edit');
                Route::put('{id}/update',       [CatalogueController::class, 'update'])->name('update');
                Route::get('{id}/destroy',      [CatalogueController::class, 'destroy'])->name('destroy');
            });


            
        // Route::resource('categories',   CatalogueController::class);
        Route::resource('products',             ProductController::class);

        // Counpons
        Route::resource('coupons',              CouponController::class);

        // Banners
        Route::resource('banners',                  SliderController::class);
        Route::get('banners/{banner}',              [SliderController::class, 'changeStatus'])->name('changestatus');
        
        // Bills
        Route::resource('bills',                        BillController::class);
        Route::get('bills/confirm/{order}',             [BillController::class, 'confirmBill'])->name('confirmBill');
        Route::get('bills/sendbill/{order}/{email}',    [MailController::class, 'senMailBill'])->name('sendmailbill');
    });
