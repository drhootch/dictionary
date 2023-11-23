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



Route::any('task/lemmatize', 'App\Http\Controllers\APIHandler2@getLemmatize');

Route::any('task/postag', 'App\Http\Controllers\APIHandler@getPOSTag');


Route::any('task2/lexical-analysis', 'App\Http\Controllers\APIHandler2@getLexicalAnalysis');

Route::any('entry2/process', 'App\Http\Controllers\APIHandler2@processEntry');
