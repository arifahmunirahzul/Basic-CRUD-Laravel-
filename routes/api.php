<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware'=>'api', 'prefix' => 'auth'], function($router)
{
	Route::post('register', 'APIController@register');
	Route::post('login', 'APIController@authenticate');
	Route::post('forgot/password', 'Auth\ForgotPasswordController');
});

Route::group(['middleware'=>'jwt.verify'], function($router)
{
	Route::post('logout', 'APIController@logout');
	Route::post('create-aduan', 'APIController@CreateAduan');
	Route::get('get-all-aduan', 'APIController@GetAllAduan');
	Route::get('get-aduan/{user_id}', 'APIController@GetAduan');
	Route::post('update-aduan/{aduan_id}', 'APIController@UpdateAduan');
	Route::delete('delete-aduan/{aduan_id}', 'APIController@DeleteAduan');
});

