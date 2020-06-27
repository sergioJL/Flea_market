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

Route::get('/', 'Home\indexController@index');

/**
 * 用户注册
 */
/*
Route::any('user/register',function (){
    return view('User.register');
});*/
Route::group(['prefix'=>'user','middleware' => ['web']],function (){
    //用户登录
    Route::any('login','User\UserVerification@login');
    //用户注册
    Route::any('register','User\UserVerification@register');

    Route::get('logout','User\UserVerification@logout');

    Route::group(['prefix'=>'change','middleware' => ['web']],function () {
        Route::any('nickname','User\UserVerification@changeNickName');
        Route::any('psd','User\UserVerification@changePsd');
        Route::any('phonenum','User\UserVerification@changePhoneNum');
    });

    //手机验证码
    Route::any('sendcode','SMS\SmsController@sendSms');
    //忘记密码
    Route::get('forget','User\UserVerification@forget');
    //用户所有信息
    Route::get('all','User\UserController@getUserMsg');
    //我发布的物品
    Route::get('myproducts','User\UserController@getMyproduct');
    //我想要的（按钮点击事件）
    Route::get('Iwant/{id}','User\UserController@getIwant');
    //我想要的
    Route::get('Iwanted','User\UserController@getIwanted');

    Route::get('Iwatneddel','User\UserController@getIwanted_del');

    Route::any('IfindProduct','Home\ProductsController@AddFindProduct');

    Route::get('Ifinded','User\UserController@Ifind');
    //留言
    //Route::get('sendMessage','User\UserController@leave_message');
    Route::any('sendMessage','Home\MessageController@addMes');
    Route::any('sendMessageTest','Home\MessageController@addMesTest');

    //留言回复
    Route::get('replyMessage','User\UserController@relpyMessage');

    Route::get('allMesaages','User\UserController@myallmessage');

    Route::get('allMessageReply','User\UserController@getMessageOnProductDetail');

    Route::get('pwd/{pwd}',function ($pwd=null){
        return 'te04/pwd:'.$pwd ;
    });

    Route::any('safe',function (){
        return view('User.safe');
    });

    Route::get('notice','User\UserController@getNotice');
});

/*
Route::any('user/register','User\RegisterController@register');
Route::get('user/login','User\LoginController@login');
Route::any('user/sendcode','SMS\SmsController@sendSms');
Route::get('user/forget','User\RegisterController@forget');
Route::get('user/all','User\UserController@getUserMsg');
Route::get('user/myproducts','User\UserController@getMyproduct');
Route::get('user/Iwant','User\UserController@getIwant')->name('Iwant');
Route::get('user/Iwanted','User\UserController@getIwanted');
Route::get('user/sendMessage','User\UserController@leave_message');
Route::get('user/replyMessage','User\UserController@relpyMessage');
*/
Route::any('product/add','Home\ProductsController@AddProduct')->middleware('web');

Route::any('product/showall','Home\ProductsController@showall')->middleware('web');

Route::any('product/show_all_t','Home\ProductsController@showall_t')->middleware('web');

Route::get('product/detail/{id}','Home\ProductsController@showDetail')->middleware('web');

Route::get('product/detail_replay','User\UserController@setMessageReaded')->middleware('web');

Route::get('product/delete/{id}','Home\ProductsController@deleteProduct')->middleware('web');

Route::get('product/deleteNode/{id}','Home\ProductsController@deleteProductNode')->middleware('web');

Route::get('product/deleteIwantProduct/{id}','Home\ProductsController@deleteIwantProduct')->middleware('web');

Route::get('product/deleteMessage/{id}','User\UserController@deleteMessage')->middleware('web');

Route::get('product/te_view',function (){
   return view('Product.addproduct');
});

Route::any('product/search','Home\ProductsController@search');

Route::get('product/showfind','Home\ProductsController@showfind');

Route::any('product/change/price','User\UserController@changePrice');

Route::get('test','Home\ProductsController@test');

Route::get('testMessage','Home\ProductsController@testMessage');

Route::get('testSearch',function (){
    return view('Product.ProductSearch');
});

Route::group(['prefix'=>'admin','middleware' => ['web']],function () {
    Route::any('login', 'User\AdminController@login');

    Route::get('home', function () {
        return redirect('/tobeprocess');
    });

    Route::get('tobeprocess', 'User\AdminController@getNotice');

    Route::get('userlist', 'User\AdminController@getUsers');

    Route::get('productlist/{type}', 'User\AdminController@getProducts');

    Route::get('Messagelist', 'User\AdminController@getMessages');

    Route::any('gonggao','User\AdminController@addAnnouncement');
});

Route::group(['prefix'=>'del','middleware' => ['web']],function (){

   Route::get('mes/{id}','Home\MessageController@delMes');

   Route::get('user/{id}','User\UserController@deleteUser');
});

Route::get('testsendcode',function (){
    return view('User.register');
});

Route::get('getUnreadMessage','User\UserController@getUnreadMessage');



Route::get('help',function (){
    return view('Product.helper');
});
Route::get('notice',function (){
    return view('User.notice');
});
