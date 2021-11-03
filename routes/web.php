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
    Route::get('/product/{id}', 'SiteController@productDetail');
});


Route::group(['prefix' => 'admin'], function(){
    Route::get('/', 'DashboardController@index');

    Route::get('/report/stock', 'ReportController@stock')->name('report.stock');
    Route::get('/report/stock/{id}', 'ReportController@stock_flow')->name('report.stock_flow');

    Route::get('/promo', 'PromoController@index')->name('promo');
    Route::post('/promo/add', 'PromoController@add')->name('promo.add');
    Route::post('/promo/edit/{id}', 'PromoController@edit')->name('promo.edit');
    Route::delete('/promo/delete/{id}', 'PromoController@delete')->name('promo.delete');

    Route::get('/promo/detail/{id}', 'PromoDetailController@index')->name('promo_detail');
    Route::post('/promo/detail/{id}/add', 'PromoDetailController@add')->name('promo_detail.add');
    Route::post('/promo/detail/{id}/edit/{iddetail}', 'PromoDetailController@edit')->name('promo_detail.edit');
    Route::delete('/promo/detail/{id}/delete/{iddetail}', 'PromoDetailController@delete')->name('promo_detail.delete');

    Route::get('/refund', 'RefundController@index')->name('refund');
    Route::post('/refund/add', 'RefundController@add')->name('refund.add');
    Route::post('/refund/edit/{id}', 'RefundController@edit')->name('refund.edit');
    Route::delete('/refund/delete/{id}', 'RefundController@delete')->name('refund.delete');

    Route::get('/order', 'OrderController@index')->name('order');
    Route::post('/order/add', 'OrderController@add')->name('order.add');
    Route::post('/order/edit/{id}', 'OrderController@edit')->name('order.edit');
    Route::delete('/order/delete/{id}', 'OrderController@delete')->name('order.delete');

    Route::get('/order/detail/{id}', 'OrderDetailController@index')->name('order_detail');
    Route::post('/order/detail/{id}/add', 'OrderDetailController@add')->name('order_detail.add');
    Route::post('/order/detail/{id}/edit/{iddetail}', 'OrderDetailController@edit')->name('order_detail.edit');
    Route::delete('/order/detail/{id}/delete/{iddetail}', 'OrderDetailController@delete')->name('order_detail.delete');

    Route::get('/customer', 'CustomerController@index')->name('customer');
    Route::post('/customer/add', 'CustomerController@add')->name('customer.add');
    Route::post('/customer/edit/{id}', 'CustomerController@edit')->name('customer.edit');
    Route::delete('/customer/delete/{id}', 'CustomerController@delete')->name('customer.delete');

    Route::get('/faq', 'FaqController@index')->name('faq');
    Route::post('/faq/add', 'FaqController@add')->name('faq.add');
    Route::post('/faq/edit/{id}', 'FaqController@edit')->name('faq.edit');
    Route::delete('/faq/delete/{id}', 'FaqController@delete')->name('faq.delete');

    Route::get('/color', 'ColorController@index')->name('color');
    Route::post('/color/add', 'ColorController@add')->name('color.add');
    Route::post('/color/edit/{id}', 'ColorController@edit')->name('color.edit');
    Route::delete('/color/delete/{id}', 'ColorController@delete')->name('color.delete');

    Route::get('/size', 'SizeController@index')->name('size');
    Route::post('/size/add', 'SizeController@add')->name('size.add');
    Route::post('/size/edit/{id}', 'SizeController@edit')->name('size.edit');
    Route::delete('/size/delete/{id}', 'SizeController@delete')->name('size.delete');

    Route::get('/channel', 'ChannelController@index')->name('channel');
    Route::post('/channel/add', 'ChannelController@add')->name('channel.add');
    Route::post('/channel/edit/{id}', 'ChannelController@edit')->name('channel.edit');
    Route::delete('/channel/delete/{id}', 'ChannelController@delete')->name('channel.delete');

    Route::get('/category', 'CategoryController@index')->name('category');
    Route::post('/category/add', 'CategoryController@add')->name('category.add');
    Route::post('/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::delete('/category/delete/{id}', 'CategoryController@delete')->name('category.delete');

    Route::get('/product', 'ProductController@index')->name('product');
    Route::post('/product/add', 'ProductController@add')->name('product.add');
    Route::post('/product/edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::delete('/product/delete/{id}', 'ProductController@delete')->name('product.delete');

    Route::get('/product/detail/{id}', 'ProductDetailController@index')->name('product_detail');
    Route::post('/product/detail/{id}/add', 'ProductDetailController@add')->name('product_detail.add');
    Route::post('/product/detail/{id}/edit/{iddetail}', 'ProductDetailController@edit')->name('product_detail.edit');
    Route::delete('/product/detail/{id}/delete/{iddetail}', 'ProductDetailController@delete')->name('product_detail.delete');

    Route::get('/purchasing', 'PurchasingController@index')->name('purchasing');
    Route::post('/purchasing/add', 'PurchasingController@add')->name('purchasing.add');
    Route::post('/purchasing/edit/{id}', 'PurchasingController@edit')->name('purchasing.edit');
    Route::delete('/purchasing/delete/{id}', 'PurchasingController@delete')->name('purchasing.delete');

    Route::get('/production/request', 'ProductionRequestController@index')->name('production.request');
    Route::get('/production/request/search', 'ProductionRequestController@search')->name('production.request.search');
    Route::post('/production/request/add', 'ProductionRequestController@add')->name('production.request.add');
    Route::post('/production/request/append', 'ProductionRequestController@append')->name('production.request.append');
    Route::post('/production/request/edit/{id}', 'ProductionRequestController@edit')->name('production.request.edit');
    Route::delete('/production/request/delete/{id}', 'ProductionRequestController@delete')->name('production.request.delete');

    Route::get('/production/actual', 'ProductionActualController@index')->name('production.actual');
    Route::get('/production/actual/search', 'ProductionActualController@search')->name('production.actual.search');
    Route::post('/production/actual/edit/{id}', 'ProductionActualController@edit')->name('production.actual.edit');
    Route::delete('/production/actual/delete/{id}', 'ProductionActualController@delete')->name('production.actual.delete');

    Route::get('/production/defect', 'ProductionDefectController@index')->name('production.defect');
    Route::get('/production/defect/search', 'ProductionDefectController@search')->name('production.defect.search');
    Route::post('/production/defect/edit/{id}', 'ProductionDefectController@edit')->name('production.defect.edit');
    Route::delete('/production/defect/delete/{id}', 'ProductionDefectController@delete')->name('production.defect.delete');

    Route::get('/testimony', 'TestimonyController@index')->name('testimony');
    Route::post('/testimony/add', 'TestimonyController@add')->name('testimony.add');
    Route::post('/testimony/edit/{id}', 'TestimonyController@edit')->name('testimony.edit');
    Route::delete('/testimony/delete/{id}', 'TestimonyController@delete')->name('testimony.delete');

    // Route::get('/catalogue', 'SiteController@catalogue')->name('catalogue');
    // Route::get('/how-to-order', 'SiteController@howToOrder');
    // Route::get('/faq', 'SiteController@faq');
    // Route::get('/size-recomendation', 'SiteController@sizeRecomendation');
    // Route::get('/feedback', 'SiteController@feedback');
    // Route::get('/{slug}', 'SiteController@productDetail');
});