<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Subscribed;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ReservationController;

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

Route::get('/',  [WebController::class, 'index'])->name('top');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('shops', ShopController::class);
    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('favorites/{shop_id}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{shop_id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/dashboard', function () {})->middleware([Subscribed::class]);

    Route::controller(UserController::class)->group(function () {
        Route::get('users/mypage', 'mypage')->name('mypage');
        Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
        Route::put('users/mypage', 'update')->name('mypage.update');
        Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
        Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');
        Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite');
        Route::delete('users/mypage/delete', 'destroy')->name('mypage.destroy');
        Route::get('users/mypage/cart_history', 'cart_history_index')->name('mypage.cart_history');
    });

    Route::controller(SubscriptionController::class)->group(function () {
        Route::get('subscription/index', 'index')->name('subscription.create');
        Route::post('subscription/store', 'store')->name('subscription.store');
        Route::get('subscription/update', 'update')->name('subscription.cancel');
        Route::put('subscription/edit', 'edit')->name('subscription.edit');
        Route::get('subscription/cancel', 'cancel')->name('subscription.cancel');
    });

    Route::controller(ReservationController::class)->group(function () {
        Route::get('reservations/index', [ReservationController::class, 'index'])->name('reservation.index');
        Route::get('reservations/create/{store_id}', [ReservationController::class, 'create'])->name('reservation.create');
        Route::post('reservations/store', [ReservationController::class, 'store'])->name('reservation.store');
    });

    Route::controller(CheckoutController::class)->group(function () {
        Route::get('checkout', 'index')->name('checkout.index');
        Route::post('checkout', 'store')->name('checkout.store');
        Route::get('checkout/success', 'success')->name('checkout.success');
    });
});