<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return redirect('/site');
    // return "Index";
});

// Route::get('site/',function(){
// //     return redirect('/site');
// // });

Route::group(['prefix' => 'site'], function(){
    Route::get('/', 'SiteController@index');
    Route::get('/catalogue', 'SiteController@catalogue')->name('catalogue');
    Route::get('/how-to-order', 'SiteController@howToOrder');
    Route::get('/faq', 'SiteController@faq');
    Route::get('/size-recomendation', 'SiteController@sizeRecomendation');
    Route::get('/feedback', 'SiteController@feedback');
    Route::get('/{slug}', 'SiteController@productDetail');
});