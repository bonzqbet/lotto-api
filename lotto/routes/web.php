<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\CheckControler;

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


Route::fallback(function () {  // set all route to home
    return view('front.home');
});

Route::get('/', function () {
    return view('front.home');
});


Route::get('/home', function () {
    return view('front.home');
});


Route::get('/lotte',[ScraperController::class, 'scraper']);
Route::get('/check',[CheckControler::class, 'check']);
Route::get('/api/view',[ScraperController::class, 'viewAPI']);
Route::get('/loadDate',[ScraperController::class, 'screaperDate']);
Route::get('/scraperShow',[ScraperController::class, 'scraperShow']);





