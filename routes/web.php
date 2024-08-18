<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;







Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/dashboard/index', function () {
        return view('Dashboard.index');
    })->name('dashboard.index');


    Route::group(
        ['namespace' => 'App\Http\Controllers\Dashboard\Restaurant',
            'prefix' => 'restaurant'],
        function () {
            Route::controller('RestaurantController')->group(function () {

                Route::get('all', 'all')->name('restaurants')->middleware('can:read restaurants');
                Route::get('profile/{id}', 'show')->name('restaurant.show')->middleware('can:read restaurants');
                Route::delete('profile/delete/{id}', 'delete')->name('restaurant.delete')->middleware('can:delete restaurant');
                Route::put('status/{id}', 'active')->name('restaurant.active')->middleware('can:accept restaurant');
                Route::get('products/{id}','products')->name('restaurant.products')->middleware('can:read restaurants');
                Route::get('orders/{id}','orders')->name('restaurant.orders')->middleware('can:read restaurants');

            });

            Route::resource('category','CategoryController')->middleware('can:create category');

            Route::get('commissions/monthly','CommissionController@getMonthlyCommissions')->name('commissions.monthly')->middleware('can:read commission');
            Route::get('payment/create','CommissionController@create')->name('payment.create')->middleware('can:create payment');
            Route::post('payment/store','CommissionController@store')->name('payment.store')->middleware('can:create payment');
            Route::get('payments','CommissionController@index')->name('payment.index')->middleware('can:read payments');
            Route::get('payment/edit/{id}','CommissionController@edit')->name('payment.edit')->middleware('can:edit payment');
            Route::post('payment/update/{id}','CommissionController@update')->name('payment.update')->middleware('can:edit payment');
            Route::delete('payment/delete/{id}','CommissionController@delete')->name('payment.delete')->middleware('can:delete payment');

            Route::get('offers','OfferController@index')->name('offer.index');
            Route::delete('offer/delete/{id}','OfferController@delete')->name('offer.delete')->middleware('can:delete offers');



        });

    Route::group(
        ['namespace' => 'App\Http\Controllers\Dashboard\Client',
            'prefix' => 'client'],
        function () {
            Route::controller('ClientController')->group(function () {

                Route::get('all', 'all')->name('clients')->middleware('can:read client');
                Route::get('profile/{id}', 'show')->name('client.show')->middleware('can:read client');
                Route::delete('profile/delete/{id}', 'delete')->name('client.delete')->middleware('can:delete client');
                Route::get('orders/{id}','orders')->name('client.orders')->middleware('can:read client');

            });
        });

    Route::controller('App\Http\Controllers\Api\ContactController')->group(function () {
        Route::get('contacts','all')->name('contacts')->middleware('can:read message');
        Route::get('contact/{id}','show')->name('contact.show')->middleware('can:read message');
        Route::get('contact/delete/{id}','delete')->name('contact.delete')->middleware('can:delete message');

    });


    Route::controller('App\Http\Controllers\Dashboard\SettingController')->group(function () {

        Route::get('setting/general','general')->name('setting.general')->middleware('can: settings');
        Route::post('setting/general/update','update_general')->name('setting.general.update')->middleware('can: settings');

        Route::get('setting/commission','commission')->name('setting.commission')->middleware('can: read commission');
        Route::post('setting/commission/update','update_commission')->name('setting.commission.update')->middleware('can: edit commission');

        Route::get('setting/about','about')->name('setting.about')->middleware('can: settings');
        Route::post('setting/about/update','update_about')->name('setting.about.update')->middleware('can: settings');

    });

    Route::controller('App\Http\Controllers\Dashboard\CityController')->group(function () {

        Route::get('cities','index')->name('city.index');
        Route::get('city/create','create')->name('city.create')->middleware('can: create cities');
        Route::get('city/{id}','show')->name('city.show');
        Route::get('city/edit/{id}','edit')->name('city.edit')->middleware('can: edit cities');
        Route::delete('city/delete/{id}','delete')->name('city.delete')->middleware('can: delete cities');
        Route::post('city/store','store')->name('city.store')->middleware('can: create cities');
        Route::post('city/update/{id}','update')->name('city.update')->middleware('can: edit cities');

    });

    Route::controller('App\Http\Controllers\Dashboard\RegionController')->group(function () {

        Route::get('regions','index')->name('region.index');
        Route::get('region/create','create')->name('region.create')->middleware('can: create regions');
        Route::get('region/{id}','show')->name('region.show');
        Route::get('region/edit/{id}','edit')->name('region.edit')->middleware('can: create regions');
        Route::delete('region/delete/{id}','delete')->name('region.delete')->middleware('can: delete regions');
        Route::post('region/store','store')->name('region.store')->middleware('can: create regions');
        Route::post('region/update/{id}','update')->name('region.update')->middleware('can: edit regions');

    });

    Route::controller('App\Http\Controllers\Dashboard\OrderController')->group(function () {

        Route::get('orders','index')->name('order.index')->middleware('can: read orders');
        Route::get('order/current','current')->name('order.current')->middleware('can: read orders');
        Route::get('order/pending','pending')->name('order.pending')->middleware('can: read orders');
        Route::get('order/previous','previous')->name('order.previous')->middleware('can: read orders');
        Route::get('order/{id}','show')->name('order.show')->middleware('can: read orders');
        Route::get('order/{id}/print','print')->name('order.print')->middleware('can: read orders');

    });

    Route::controller('App\Http\Controllers\Dashboard\UserController')->group(function () {

        Route::get('users','index')->name('user.index')->middleware('can: read user');
        Route::get('user/create','create')->name('user.create')->middleware('can: create user');
        Route::post('user/store','store')->name('user.store')->middleware('can: create user');
        Route::get('user/{id}','show')->name('user.show')->middleware('can: read user');
        Route::delete('user/delete/{id}','delete')->name('user.destroy')->middleware('can: delete user');

    });

    Route::middleware(['auth', 'can:create permission'])->group(function () {
    Route::controller('App\Http\Controllers\Dashboard\PermissionController')->group(function () {

            Route::get('permissions', 'index')->name('permission.index');
            Route::get('permission/create', 'create')->name('permission.create');
            Route::post('permission/store', 'store')->name('permission.store');
            Route::get('permission/edit/{id}', 'edit')->name('permission.edit');
            Route::put('permission/update/{id}', 'update')->name('permission.update');
            Route::delete('permission/destroy/{id}', 'destroy')->name('permission.destroy');

    });

    Route::controller('App\Http\Controllers\Dashboard\RoleController')->group(function () {
        Route::get('roles', 'index')->name('role.index');
        Route::get('role/create', 'create')->name('role.create');
        Route::post('role/store', 'store')->name('role.store');
        Route::get('role/edit/{id}','edit')->name('role.edit');
        Route::put('role/update/{id}','update')->name('role.update');
        Route::delete('role/destroy/{id}','destroy')->name('role.destroy');
        Route::get('user/role/{id}','userPermission')->name('user.role');


        Route::get('user_permission/{id}', 'userPermission')->name('user.permission');
        Route::post('add_permission/{id}', 'addPermission')->name('add.permission');
    });
    });
});
require __DIR__.'/auth.php';
