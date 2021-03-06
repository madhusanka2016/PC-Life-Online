<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'uses' => 'ProductController@getIndex',
    'as' => 'product.index'
]);

Route::get('/send', [
    'uses' => 'EmailController@send',
    'as' => 'user.sendMail'
]);

Route::get('/send_test', function () {
    Mail::raw('Sending emails with Mailgun and Laravel is easy!', function ($message) {
        $message->to('nimesha95@live.com');
    });
});

Route::get('/desktops/{type}/{brand?}', [
    'uses' => 'ProductController@getDesktops',
    'as' => 'product.product'
]);

Route::get('/laptops/{type}/{brand?}', [
    'uses' => 'ProductController@getLaptops',
    'as' => 'product.product'
]);

Route::get('/product/{id}', [
    'uses' => 'ProductController@showItem',
    'as' => 'product.show'
]);

Route::get('/logout', [
    'uses' => 'UserController@getLogout',
    'as' => 'user.logout',
    'middleware' => 'auth'
]);

Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/signup', [
            'uses' => 'UserController@getSignup',
            'as' => 'user.signup'
        ]);

        Route::post('/signup', [
            'uses' => 'UserController@postSignup',
            'as' => 'user.signup'
        ]);

        Route::get('/signin', [
            'uses' => 'UserController@getSignin',
            'as' => 'user.signin'
        ]);

        Route::post('/signin', [
            'uses' => 'UserController@postSignin',
            'as' => 'user.signin'
        ]);
    });

    Route::group(['middleware' => ['auth', 'user']], function () {
        Route::get('/profile', [
            'uses' => 'UserController@getProfile',
            'as' => 'user.profile'
        ]);

        Route::get('/profile/vieworders', [
            'uses' => 'UserController@viewOrders',
            'as' => 'user.orders'
        ]);

        Route::get('/add-to-cart/{id}', [
            'uses' => 'ProductController@getAddToCart',
            'as' => 'product.addToCart'
        ]);

        Route::get('/remove_item/{count}/{rowid}/{curcount?}', [
            'uses' => 'ProductController@getRemoveFromCart',
            'as' => 'product.RemoveFromCart'
        ]);

        Route::get('/plus_item/{rowid}/{curcount}', [
            'uses' => 'ProductController@getPlusOneCart',
            'as' => 'product.PlusOneCart'
        ]);

        Route::get('/cart', [
            'uses' => 'ProductController@getCart',
            'as' => 'user.getCart'
        ]);

        Route::get('/checkout', [
            'uses' => 'ProductController@checkout',
            'as' => 'user.checkout'
        ]);

        Route::post('/editinfo', [
            'uses' => 'UserController@postEditInfo',
            'as' => 'user.editinfo'
        ]);

        Route::get('/send_test', function () {
            Mail::raw('Sending emails with Mailgun and Laravel is easy!', function ($message) {
                $message->to('nimesha95@live.com');
            });
        });

    });

});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin', [
        'uses' => 'AdminController@getIndex',
        'as' => 'admin.index',
    ]);

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/reports', [
            'uses' => 'AdminController@getReports',
            'as' => 'admin.reports',
        ]);

        Route::get('/additems', [
            'uses' => 'AdminController@getAdditems',
            'as' => 'admin.additems',
        ]);

        Route::post('/redirect_add', [
            'uses' => 'AdminController@redirect_add',
            'as' => 'admin.redirect_add',
        ]);

        Route::post('/additems', [
            'uses' => 'AdminController@postAdditems',
            'as' => 'admin.additems',
        ]);

        Route::post('/signup', [
            'uses' => 'AdminController@postRegUser',
            'as' => 'admin.reguser'
        ]);

    });

});

Route::group(['middleware' => ['auth', 'stockmanager']], function () {
    Route::get('/stockmanager', [
        'uses' => 'StockManagerController@getIndex',
        'as' => 'stockmanager.index',
    ]);
});

Route::group(['middleware' => ['auth', 'cashier']], function () {
    Route::get('/cashier', [
        'uses' => 'CashierController@getIndex',
        'as' => 'cashier.index',
    ]);
});

Route::group(['middleware' => ['auth', 'technician']], function () {
    Route::get('/technician', [
        'uses' => 'TechnicianController@getIndex',
        'as' => 'technician.index',
    ]);


});