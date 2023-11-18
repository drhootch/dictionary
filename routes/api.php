<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// Get entry from database if cached or from API if not
Route::any('entry/process', 'App\Http\Controllers\APIHandler@processEntry');

// Get entry from API
Route::get('entry/get', 'App\Http\Controllers\APIHandler@getEntry');

// Crawl from official website
Route::get('summary', 'App\Http\Controllers\APIHandler@summary');

// Lemmatize a word using API
Route::get('lemmatize', 'App\Http\Controllers\APIHandler@getLemma');
