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

/**
 * WEB PAGES
 */
Route::get('/', function () {
    return view('welcome');
});

Route::get('/document', 'DocumentController@index');
Route::get('/document/{id}', 'DocumentController@show');

/**
 * WEB APIS
 */

Route::get('/test','TestController@action');

Route::get('/fonda/{id}','FondaController@index');

Route::post('/register', 'Member\RegisterController@action');

Route::post('/login', 'Member\LoginController@action');

// Chỉ nên dùng khi muốn remove tất cả thiết bị, nếu khônng, chỉ cần remove token trên local
Route::get('/logout', 'Member\LoginController@logout')->middleware('auth_token');

// Xác thực verify code
Route::put('/users/{id}/verify','Member\VerifyStatusController@action');

// Nhận verify code mới
Route::get('/users/{id}/verify','Member\VerifyStatusController@resend');

Route::get('/resend_password', 'Member\ResendPasswordController@action');
Route::post('/update_password', 'Member\ResendPasswordController@update')->middleware('auth_token');

Route::get('/users/{id}/profile', 'Member\ProfileController@view');
Route::put('/users/{id}/profile', 'Member\ProfileController@update')->middleware('auth_user');
Route::post('/users/profile', 'Member\ProfileController@getByToken')->middleware('auth_token');


/**
 * Location
 */

Route::group(['middleware' => 'auth_user'], function (){

    Route::get('/users/{id}/location', 'LocationController@index');

    Route::post('/users/{id}/location', 'LocationController@store');

    Route::get('/users/{id}/location/{location_id}', 'LocationController@show')
        ->middleware('location_res');

    Route::delete('/users/{id}/location/{location_id}', 'LocationController@delete')
        ->middleware('location_res');

});


/**
 * Image
 */

Route::group(['middleware' => 'auth_user'], function (){

    Route::post('/users/{id}/image', 'ImageController@store')->middleware('validate_input');

    Route::get('/users/{id}/image', 'ImageController@index');

    Route::get('/users/{id}/image/{image_id}', 'ImageController@show')->middleware('image_res');

    Route::put('/users/{id}/image/{image_id}', 'ImageController@update')->middleware('image_res');

    Route::delete('/users/{id}/image/{image_id}', 'ImageController@delete')->middleware('image_res');
});

/**
 * Fonda
 */

Route::get('/fonda', 'FondaController@index');

Route::get('/fonda/{id}', 'FondaController@show')->middleware(['fonda_res']);

Route::post('/fonda', 'FondaController@store')
    ->middleware(['auth_token', 'validate_input']);

Route::put('/fonda/{id}', 'FondaController@update')
    ->middleware(['auth_token',  'validate_input','fonda_res']);

/**
 * image for fonda
 */

Route::resource('/fonda/{id}/image','FondaImageController',[
    'only' => ['index', 'show', 'store', 'update', 'destroy']
]);

Route::resource('/fonda_group','FondaGroupController',[
    'only' => ['index', 'store']
]);

Route::resource('/fonda/{id}/sale', 'SaleController');

Route::resource('/utility', 'UtilityController',[
    'only' => ['index', 'store']
]);

Route::resource('/fonda/{id}/utility','FondaUtilityController');

Route::resource('/culinary','CulinaryController',[
    'only' => ['index', 'store']
]);

Route::resource('/fonda/{id}/culinary','FondaCulinaryController');

Route::resource('/users/{id}/comment','CommentController',
    ['only' => ['store', 'update', 'destroy']]
);

Route::get('/fonda/{id}/comment', 'CommentController@index')->middleware('fonda_res');

Route::resource('/fonda/{id}/dainty', 'FondaDaintyController');

