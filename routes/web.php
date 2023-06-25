<?php

namespace App\Http\Controllers;
use App\Http\Controllers\TrainingPaymentCertificationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('storage:link');
    return "Cache is cleared";
});
 //Route::post('/pending_enrollment_print', [BatchInfoController::class, 'pending_enrollmentPrint']);
 