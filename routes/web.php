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

// Route::get('fillable', 'CrudController@getOffers');

// use Illuminate\Routing\Route;

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// Route::get('/', function () {
//     return 'Home';
// });

Route::get('/dashboard', function () {
    return 'Not adult';
})->name('not.adult');

// Route::get('/dashboard', function () {
//     return 'dashboard';
// });

// Route::get('/redirect/{service}', 'SocialController@redirect');
// Route::get('/callback/{service}', 'SocialController@callback');

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('fillable', 'CrudController@getOffers');


// Route::group(['prefix' => 'offers'], function () {
//     Route::get('store', 'CrudController@store');
// });

// Route::get('contacts', 'ContactController@index');

// Route::get('portfile', 'PortFileController@index');


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::group(['prefix' => 'offers'], function () {
        //   Route::get('store', 'CrudController@store');
        Route::get('create', 'CrudController@create');
        Route::post('store', 'CrudController@store')->name('offers.store');

        Route::get('edit/{offer_id}', 'CrudController@edit')->name('offers.edit');
        Route::post('update/{offer_id}', 'CrudController@update')->name('offers.update');
        Route::get('delete/{offer_id}', 'CrudController@delete')->name('offers.delete');
        Route::get('all', 'CrudController@all')->name('offers.all');
        // Route::get('get-all-inactive-offer', 'CrudController@getAllInactiveOffers');
    });
    Route::get('youtube', 'CrudController@getVideo')->middleware('auth');
});


################  Begin Ajax Route ##################
Route::group(['prefix' => 'ajax-offers'], function () {
    Route::get('create', 'OfferController@create');
    Route::post('store', 'OfferController@store')->name('ajax.offers.store');
    Route::get('all', 'OfferController@all')->name('ajax.offers.all');
    Route::post('delete', 'OfferController@delete')->name('ajax.offers.delete');
    Route::get('edit/{offer_id}', 'OfferController@edit')->name('ajax.offers.edit');
    Route::post('update', 'OfferController@update')->name('ajax.offers.update');
});
################  End Ajax Route ####################


################  Begin Authentication &&  Guards ##################
Route::group(['middleware' => 'CheckAge', 'namespace' => 'Auth'], function () {
    Route::get('adults', 'CustomAuthController@adualt')->name('adult');
});
Route::get('site', 'Auth\CustomAuthController@site')->middleware('auth:web')->name('site');
Route::get('admin', 'Auth\CustomAuthController@admin')->middleware('auth:admin')->name('admin');

Route::get('admin/login', 'Auth\CustomAuthController@adminLogin')->name('admin.login');
Route::post('admin/login', 'Auth\CustomAuthController@checkAdminLogin')->name('save.admin.login');

################  End Authentication &&  Guards ####################



################### Begin relations routes ######################

Route::get('has-one', 'Relation\RelationsController@hasOneRelation');

Route::get('get-one-reserve', 'Relation\RelationsController@hasOneRelationReverse');

Route::get('get-user-has-phone', 'Relation\RelationsController@getUserHasPhone');

Route::get('get-user-has-phone-with-condition', 'Relation\RelationsController@getUserWhereHasPhoneWithCondition');

Route::get('get-user-not-has-phone', 'Relation\RelationsController@getUserNotHasPhone');
################### End relations routes ########################
