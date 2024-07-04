<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\CategoryController;
use App\Admin\Controllers\ShopController;
use App\Admin\Controllers\MajorCategoryController;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\SubscriptionController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('categories', CategoryController::class);
    $router->resource('shops', ShopController::class);
    $router->resource('major-categories', MajorCategoryController::class);
    $router->resource('users', UserController::class);
    $router->resource('subscriptions', SubscriptionController::class)->only('index');

});
