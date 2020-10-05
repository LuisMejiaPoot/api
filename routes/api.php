<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckHeaders;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|composer dump-autoload
php artisan clear-compiled
php artisan optimize
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();

// });
// Route::post('/register', 'Api\AuthController@register');
// Route::post('/login', 'Api\AuthController@login');
// $api->version('v1',function ($api) {
//     $api->post('/register', 'App\Http\Controllers\Api\AuthController@register');
// });


// $api->version('v1', function ($api) {
//     $api->group(['middleware' => 'auth_api'], function ($api) {
//         $api->post('/register', 'App\Http\Controllers\Api\AuthController@register');
//     });
// });

// $api->version('v1',  function ($api) {
//     $api->post('/login',["middleware" =>CheckHeaders::class ], 'App\Http\Controllers\Api\AuthController@login');
//     $api->post('/logout', 'App\Http\Controllers\Api\AuthController@logout');
// });


$api->version('v1', function ($api) {
    $api->group(["middleware"=>CheckHeaders::class], function ($api) {
        $api->post('/login','App\Http\Controllers\Api\AuthController@login');
        $api->post('/oauth/tokens', 'App\Http\Controllers\Api\AuthController@Tokes');
    });
});

// $api->version('v1',  function ($api) {/oauth/clients
    
// });
// CheckHeaders::class
// "App\Http\Middleware" => 'auth_api'
$api->version('v1', function ($api) {
    $api->group(["middleware"=>'auth:api'], function ($api) {
        $api->post('/register', 'App\Http\Controllers\Api\AuthController@register');
        // $api->post('/login', 'App\Http\Controllers\Api\AuthController@login');
    });
});




// $api->version('v1', function ($api) {
//     $api->group(['middleware' => 'auth_api'], function ($api) {
//         $api->post('/register', 'App\Http\Controllers\Api\AuthController@register');
//     });
// });

// $api->group('v1',['middleware' => 'api_auth'], function ($api) {
//     $api->post('/register', 'App\Http\Controllers\Api\AuthController@register');
// });
// $api->version('v1',  function ($api) {
//     // $api->post('/login', 'App\Http\Controllers\Api\AuthController@login');
//     $api->post('/login', ['as' => 'login', 'uses' => 'App\Http\Controllers\Api\AuthController@login']);
// });


// Route::apiResource('/ceo', 'Api\ClientsController')->middleware('auth:api');
