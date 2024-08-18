<?php

use App\Http\Controllers\API\Restaurant\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::controller('App\Http\Controllers\Api\ContactController')->group(function () {
    Route::post('contact','store');
    Route::get('contacts','all');
    Route::get('contact/{id}','show');
    Route::post('contact/delete/{id}','delete');
});

Route::controller('App\Http\Controllers\Api\SettingController')->group(function () {
    Route::get('about','about');
    Route::get('commission','commission');
    Route::get('social','social');


});




    /////////////////////////////////////  Restaurant /////////////////////////////////////

    Route::group(
        ['namespace' => 'App\Http\Controllers\API\Restaurant',
            'prefix' => 'restaurant'],
        function () {
            Route::controller('AuthController')->group(function () {
                Route::post('/register', 'register');
                Route::post('/login','login');
                Route::post('/logout','logout')->middleware('auth:sanctum');
                Route::post('send_email_reset','sendResetLinkEmail');
                Route::post('reset_password','reset_password');

            });

            Route::group(
                [ 'middleware' => 'auth:sanctum'],
                function () {
                    Route::controller('ProfileController')->group(function () {

                        Route::get('profiles', 'all');
                        Route::get('profile/{id}', 'show');
                        Route::put('profile/update', 'update');
                        Route::delete('profile/delete/{id}', 'delete');

                    });

                    Route::controller('ProductController')->group(function (){

                        Route::post('product/create','store');
                        Route::get('products','all');
                        Route::get('product/{id}','show');
                        Route::put('product/update/{id}','update');
                        Route::delete('product/delete/{id}','delete');

                    });

                    Route::controller('OfferController')->group(function (){

                       Route::post('offer/create','create');
                       Route::get('offers','all');
                       Route::get('offer/{id}','show');
                       Route::put('offer/update/{id}','update');
                       Route::delete('offer/delete/{id}','delete');


                    });

                    Route::controller('OrderController')->group(function (){

                        Route::put('set_status/{id}','status');
                        Route::get('order/current','current');
                        Route::get('order/pending','pending');
                        Route::get('order/previous','previous');

                    });
                });

//            Route::put('profile/update', 'ProfileController@update');

    });

    //////////////////////////////////  Client //////////////////////////////////////

    Route::group(
        ['namespace' => 'App\Http\Controllers\API\Client',
            'prefix' => 'client'],
        function () {

            Route::controller('AuthController')->group(function () {
                Route::post('/register', 'register');
                Route::post('/login', 'login');
                Route::post('/logout', 'logout')->middleware('auth:sanctum');
                Route::post('send_email_reset', 'sendResetLinkEmail');
                Route::post('reset_password', 'reset_password');

            });

            Route::group(
                ['middleware' => 'auth:sanctum'],
                function () {

                    Route::controller('ProfileController')->group(function () {

                        Route::get('profiles', 'all');
                        Route::get('profile/{id}', 'show');
                        Route::put('profile/update', 'update');
                        Route::delete('profile/delete/{id}', 'delete');
                    });

                    Route::controller('OrderController')->group(function () {

                        Route::post('order/create', 'create');
                        Route::get('order/{id}','show');
                        Route::get('order/details/{id}','details');

                    });

                    Route::controller('ReviewController')->group(function () {

                        Route::post('review/create', 'store');
                        Route::get('review/{id}','show');
                        Route::get('reviews/restaurant/{id}','restaurant');

                    });


                });


        });
