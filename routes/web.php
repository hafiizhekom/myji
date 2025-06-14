<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\ProcessQueue;

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

Auth::routes();

// Route::get('site/',function(){
// //     return redirect('/site');
// // });

Route::group(['prefix' => 'site'], function(){
    Route::get('/', 'SiteController@index');
    Route::get('/catalogue', 'SiteController@catalogue')->name('shop.catalogue');
    Route::get('/how-to-order', 'SiteController@howToOrder');
    Route::get('/faq', 'SiteController@faq');
    Route::get('/size-recommendation', 'SiteController@sizeRecomendation');
    Route::get('/feedback', 'SiteController@feedback')->name('shop.feedback');
    Route::get('/feedback/send', 'SiteController@sendFeedback')->name('shop.feedback.add');
    Route::get('/feedback_idea/send', 'SiteController@sendFeedbackidea')->name('shop.feedback_idea.add');
    // Route::get('/product/{id}', 'SiteController@productDetail');
    Route::get('/product/{id}', 'SiteController@product');
});


Route::get('phpmyinfo', function () {
    phpinfo(); 
})->name('phpmyinfo');

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::middleware(['verified','auth'])->group(function () {

    Route::group(['prefix' => 'admin'], function(){
        Route::get('/', 'DashboardController@index');

        Route::get('/export/production/{id}', 'ExportController@production')->name('export.excel.production');;
    
        Route::get('/report/stock', 'ReportController@stock')->name('report.stock');
        Route::get('/report/production/estimation', 'ReportController@production_estimation')->name('report.production.estimation');
        Route::get('/report/production', 'ReportController@production')->name('report.production');
        Route::get('/report/stock/{id}', 'ReportController@stock_flow')->name('report.stock_flow');

        Route::get('/user', 'UserController@index')->name('user');
        Route::post('/user/add', 'UserController@add')->name('user.add');
        Route::post('/user/edit/{id}', 'UserController@edit')->name('user.edit');
        Route::post('/user/change_password/{id}', 'UserController@change_password')->name('user.change_password');
        Route::delete('/user/delete/{id}', 'UserController@delete')->name('user.delete');
    
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

        Route::get('/endorse', 'EndorseController@index')->name('endorse');
        Route::post('/endorse/add', 'EndorseController@add')->name('endorse.add');
        Route::post('/endorse/edit/{id}', 'EndorseController@edit')->name('endorse.edit');
        Route::delete('/endorse/delete/{id}', 'EndorseController@delete')->name('endorse.delete');
    
        Route::get('/endorse/detail/{id}', 'EndorseDetailController@index')->name('endorse_detail');
        Route::post('/endorse/detail/{id}/add', 'EndorseDetailController@add')->name('endorse_detail.add');
        Route::post('/endorse/detail/{id}/edit/{iddetail}', 'EndorseDetailController@edit')->name('endorse_detail.edit');
        Route::delete('/endorse/detail/{id}/delete/{iddetail}', 'EndorseDetailController@delete')->name('endorse_detail.delete');
    
        Route::get('/customer', 'CustomerController@index')->name('customer');
        Route::post('/customer/add', 'CustomerController@add')->name('customer.add');
        Route::post('/customer/edit/{id}', 'CustomerController@edit')->name('customer.edit');
        Route::delete('/customer/delete/{id}', 'CustomerController@delete')->name('customer.delete');
    
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

        Route::get('/product/image/{id}', 'ProductDetailImageController@index')->name('product_detail_image');
        Route::post('/product/image/{id}/add', 'ProductDetailImageController@add')->name('product_detail_image.add');
        Route::post('/product/image/{id}/edit/{iddetail}', 'ProductDetailImageController@edit')->name('product_detail_image.edit');
        Route::delete('/product/image/{id}/delete/{iddetail}', 'ProductDetailImageController@delete')->name('product_detail_image.delete');
    
        Route::get('/purchasing', 'PurchasingController@index')->name('production.purchasing');
        Route::get('/purchasing/search', 'PurchasingController@search')->name('production.purchasing.search');
        Route::post('/purchasing/add', 'PurchasingController@add')->name('production.purchasing.add');
        Route::post('/purchasing/edit/{id}', 'PurchasingController@edit')->name('production.purchasing.edit');
        Route::delete('/purchasing/delete/{id}', 'PurchasingController@delete')->name('production.purchasing.delete');
    
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
        Route::post('/production/actual/complete/{id}', 'ProductionActualController@complete')->name('production.actual.complete');
    
        Route::get('/production/defect', 'ProductionDefectController@index')->name('production.defect');
        Route::get('/production/defect/search', 'ProductionDefectController@search')->name('production.defect.search');
        Route::post('/production/defect/edit/{id}', 'ProductionDefectController@edit')->name('production.defect.edit');
        Route::delete('/production/defect/delete/{id}', 'ProductionDefectController@delete')->name('production.defect.delete');

        Route::get('/faq', 'FaqController@index')->name('faq');
        Route::post('/faq/add', 'FaqController@add')->name('faq.add');
        Route::post('/faq/edit/increase/{id}', 'FaqController@increasingOrder')->name('faq.increasing.edit');
        Route::post('/faq/edit/decrease/{id}', 'FaqController@decreasingOrder')->name('faq.decreasing.edit');
        Route::post('/faq/edit/{id}', 'FaqController@edit')->name('faq.edit');
        Route::delete('/faq/delete/{id}', 'FaqController@delete')->name('faq.delete');
    
        Route::get('/testimony', 'TestimonyController@index')->name('testimony');
        Route::post('/testimony/add', 'TestimonyController@add')->name('testimony.add');
        Route::post('/testimony/edit/increase/{id}', 'TestimonyController@increasingOrder')->name('testimony.increasing.edit');
        Route::post('/testimony/edit/decrease/{id}', 'TestimonyController@decreasingOrder')->name('testimony.decreasing.edit');
        Route::post('/testimony/edit/{id}', 'TestimonyController@edit')->name('testimony.edit');
        Route::delete('/testimony/delete/{id}', 'TestimonyController@delete')->name('testimony.delete');
    
        Route::get('/slider', 'SliderController@index')->name('slider');
        Route::post('/slider/add', 'SliderController@add')->name('slider.add');
        Route::post('/slider/edit/increase/{id}', 'SliderController@increasingOrder')->name('slider.increasing.edit');
        Route::post('/slider/edit/decrease/{id}', 'SliderController@decreasingOrder')->name('slider.decreasing.edit');
        Route::post('/slider/edit/{id}', 'SliderController@edit')->name('slider.edit');
        Route::delete('/slider/delete/{id}', 'SliderController@delete')->name('slider.delete');

        Route::get('/feedback', 'FeedbackController@index')->name('feedback');
        Route::delete('/feedback/delete/{id}', 'FeedbackController@delete')->name('feedback.delete');

        Route::get('/feedback_idea', 'FeedbackIdeaController@index')->name('feedback_idea');
        Route::delete('/feedback_idea/delete/{id}', 'FeedbackIdeaController@delete')->name('feedback_idea.delete');

        Route::get('/setting/general', 'SettingController@index')->name('setting.general');
        Route::post('/setting/general/size_recommendation', 'SettingController@size_recommendation')->name('setting.general.size_recommendation');

        Route::get('/setting/order', 'SettingOrderController@index')->name('setting.order');
        Route::post('/setting/order/edit/{id}', 'SettingOrderController@edit')->name('setting.order.edit');

        Route::get('/setting/most_wanted', 'SettingMostWantedController@index')->name('setting.most_wanted');
        Route::post('/setting/most_wanted/add', 'SettingMostWantedController@add')->name('setting.most_wanted.add');
        Route::post('/setting/most_wanted/edit/{id}', 'SettingMostWantedController@edit')->name('setting.most_wanted.edit');
        Route::delete('/setting/most_wanted/delete/{id}', 'SettingMostWantedController@delete')->name('setting.most_wanted.delete');
        Route::post('/setting/most_wanted/increase/{id}', 'SettingMostWantedController@increasingOrder')->name('setting.most_wanted.increasing.edit');
        Route::post('/setting/most_wanted/decrease/{id}', 'SettingMostWantedController@decreasingOrder')->name('setting.most_wanted.decreasing.edit');

        Route::get('/setting/suggestion', 'SettingSuggestionController@index')->name('setting.suggestion');
        Route::post('/setting/suggestion/add', 'SettingSuggestionController@add')->name('setting.suggestion.add');
        Route::post('/setting/suggestion/edit/{id}', 'SettingSuggestionController@edit')->name('setting.suggestion.edit');
        Route::delete('/setting/suggestion/delete/{id}', 'SettingSuggestionController@delete')->name('setting.suggestion.delete');
        Route::post('/setting/suggestion/increase/{id}', 'SettingSuggestionController@increasingOrder')->name('setting.suggestion.increasing.edit');
        Route::post('/setting/suggestion/decrease/{id}', 'SettingSuggestionController@decreasingOrder')->name('setting.suggestion.decreasing.edit');

        Route::get('/setting/size_chart', 'SettingSizeChartController@index')->name('setting.size_chart');
        Route::post('/setting/size_chart/add', 'SettingSizeChartController@add')->name('setting.size_chart.add');
        Route::delete('/setting/size_chart/delete/{id}', 'SettingSizeChartController@delete')->name('setting.size_chart.delete');
        Route::post('/setting/size_chart/increase/{id}', 'SettingSizeChartController@increasingOrder')->name('setting.size_chart.increasing.edit');
        Route::post('/setting/size_chart/decrease/{id}', 'SettingSizeChartController@decreasingOrder')->name('setting.size_chart.decreasing.edit');


        // Route::get('/catalogue', 'SiteController@catalogue')->name('catalogue');
        // Route::get('/how-to-order', 'SiteController@howToOrder');
        // Route::get('/faq', 'SiteController@faq');
        // Route::get('/size-recomendation', 'SiteController@sizeRecomendation');
        // Route::get('/feedback', 'SiteController@feedback');
        // Route::get('/{slug}', 'SiteController@productDetail');
    });
});


Route::get('/test-queue', function () use ($router){
    
    for ($i = 0; $i < 5; $i++) {
        // dispatch(new App\Jobs\ProcessEmail($i));
        echo $i;
        echo "<br>";
        ProcessQueue::dispatch($i)->delay(now()->addMinutes(1))->onConnection('rabbitmq');
        echo "<br>";
    }
    
    // dispatch(new ProcessHelloWorld("Hello world dari Serverless ID!"));

    echo "<br>";
    echo "<br>";
    return '5 Jobs dispatched!';

});
Route::get('/mail', 'HomeController@sendEmail');
Route::get('/mail-queue', 'HomeController@sendEmailQueue');
