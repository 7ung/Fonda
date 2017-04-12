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
    return view('welcome');
});

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

/**
 * Location
 */
// Tất cả location, hoặc location theo city = ?
Route::get('/locations', 'LocationController@index');

// Tất cả Location theo user id.
Route::get('/users/{id}/location', 'LocationController@showByUser');

// 1 Location theo fonda id.
Route::get('/fonda/{id}/location', 'LocationController@xxx');

// Location theo location id
Route::get('/locations/{id}', 'LocationController@show');

// Tạo một location mới và gắn cho user id
Route::post('/users/{id}/location', 'LocationController@store')->middleware('auth_user');

// Tạo một location mới và gắn cho fonda
//Route::post('/fonda/{id}/location', 'LocationController@xxx');

//  Update một location theo location id
// Không cho update

Route::delete('/locations/{id}', 'LocationController@delete')->middleware('auth_token');
