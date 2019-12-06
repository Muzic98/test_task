<?php

use App\Http\Controllers\rpcApi;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
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
use JsonRPC\Server;
use App\User;
use App\Http\Resources\rpcApi as rpcApiResource;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/rpcApi', function () {
    $users = User::all();
    return $users;
});

Route::post('/jsonrpc', function () {
    $users = User::all();
    return $users;
});

Route::get('/test', function () {
    $server = new Server();
    $server->getProcedureHandler()
        ->withCallback('addition', function ($a, $b) {
            return $a + $b;
        })
        ->withCallback('random', function ($start, $end) {
            return mt_rand($start, $end);
        })
    ;

    return $server->execute();
});
