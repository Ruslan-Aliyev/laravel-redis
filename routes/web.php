<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedisController;

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

Route::get('/check-redis', function () {
    print_r(app()->make('redis'));
});

Route::get('/test-redis', function () {
    $redis = app()->make('redis');
    $redis->set('key1', 'val1');
    return $redis->get('key1');
});

Route::get('/article/{id}', [RedisController::class, 'showArticle']);
Route::get('/popularity-tally', [RedisController::class, 'popularityTally']);

Route::get('/cached-db-read', [RedisController::class, 'cachedDbRead']);

Route::middleware('throttle:3,1')->get('/throttled', [RedisController::class, 'throttledRoute']); // Limited to 3 requests per minute max
Route::middleware('throttle:custom')->get('/rate-imited', [RedisController::class, 'rateLimited']); // See RouteServiceProvider
Route::get('/rate-imited2', [RedisController::class, 'rateLimited2']);
