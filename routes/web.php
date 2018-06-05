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

Route::get('/', function () {
    return view('user.home');
})->name('anasayfa');


Route::get('/Sehir', 'admin\SehirController@listSehirler')->name('sehirler');

Route::get('/Sehir/{sehir}','admin\SehirController@showSehir')->name('sehir');

Route::get('/getJson/sehirler/{sehir?}/{mekan?}','admin\SehirController@getJson');
Route::get('/getimg/sehirler/{sehir?}/{mekan?}/{mekanid?}','admin\SehirController@getimg');


Route::group(['namespace' => 'admin','middleware'=> 'auth'],function(){

    Route::resource('admin/sehir','SehirController');
    Route::resource('admin/otel','OtelController');
        Route::get('admin/otel/{sehir}/goster','OtelController@showOtel')->name('Otel.showOteller');
        Route::get('admin/otel/{sehir}/ekle','OtelController@createOtel')->name('Otel.createOteller');
    Route::resource('admin/restoran','RestoranController');
        Route::get('admin/restoran/{sehir}/goster','RestoranController@showRestoran')->name('Restoran.showRestoranlar');
        Route::get('admin/restoran/{sehir}/ekle','RestoranController@createRestoran')->name('Restoran.createRestoranlar');
    Route::resource('admin/GezilebilecekYer','GezilebilecekYerController');
        Route::get('admin/GezilebilecekYer/{sehir}/goster','GezilebilecekYerController@showGezilecekyer')->name('GezilebilecekYer.showGezilecekyerler');
        Route::get('admin/GezilebilecekYer/{sehir}/ekle','GezilebilecekYerController@createGezilecekyer')->name('GezilebilecekYer.createGezilecekyerler');
    Route::resource('admin/TarihiYer','TarihiYerController');
        Route::get('admin/tarihiyer/{sehir}/goster','TarihiYerController@showTarihiYer')->name('TarihiYer.showTarihiYerler');
        Route::get('admin/tarihiyer/{sehir}/ekle','TarihiYerController@createTarihiYer')->name('TarihiYer.createTarihiYerler');

});


Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// Route::get('/migrate', function() {
//     $exitCode = Artisan::call('migrate:refresh');
//     return '<h1>migrated</h1>';
// });

// Route::get('/makeauth', function() {
//     $exitCode = Artisan::call('make:auth');
//     return '<h1>auth installed</h1>';
// });


// //Clear Cache facade value:
// Route::get('/clear-cache', function() {
//     $exitCode = Artisan::call('cache:clear');
//     return '<h1>Cache facade value cleared</h1>';
// });

// //Reoptimized class loader:
// Route::get('/optimize', function() {
//     $exitCode = Artisan::call('optimize');
//     return '<h1>Reoptimized class loader</h1>';
// });

// //Route cache:
// Route::get('/route-cache', function() {
//     $exitCode = Artisan::call('route:cache');
//     return '<h1>Routes cached</h1>';
// });

// //Clear Route cache:
// Route::get('/route-clear', function() {
//     $exitCode = Artisan::call('route:clear');
//     return '<h1>Route cache cleared</h1>';
// });

// //Clear View cache:
// Route::get('/view-clear', function() {
//     $exitCode = Artisan::call('view:clear');
//     return '<h1>View cache cleared</h1>';
// });

// //Clear Config cache:
// Route::get('/config-clear', function() {
//     $exitCode = Artisan::call('config:clear');
//     return '<h1>Clear Config cleared</h1>';
// });

// //Clear Config cache:
// Route::get('/config-cache', function() {
//     $exitCode = Artisan::call('config:cache');
//     return '<h1>Clear Config cleared</h1>';
// });

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/admin/login', 'Auth\LoginController@login');
Route::get('/admin/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/admin/logout', 'Auth\LoginController@logout');





