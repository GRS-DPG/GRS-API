<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Dashboard\DashboardController;

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('administrative-login', [AuthController::class, 'administrativeLogin']);
    Route::get('verify', [AuthController::class, 'verify']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('forgotPass', [AuthController::class, 'forgotPass']);
    Route::post('resetPass', [AuthController::class, 'resetPass']);
});
Route::get('/grievance-track', [ComplaintController::class, 'grievanceTrack']);


Route::prefix('occupation')->group(function () {
    Route::get('/list', [OccupationController::class, 'index']);
    Route::post('/save', [OccupationController::class, 'save']);
});

Route::prefix('qualification')->group(function () {
    Route::get('/list', [EducationalQualificationController::class, 'index']);
    Route::post('/save', [EducationalQualificationController::class, 'save']);
});

Route::prefix('nationality')->group(function () {
    Route::get('/list', [NationalityController::class, 'index']);
    Route::post('/save', [NationalityController::class, 'save']);
});

Route::prefix('complainant')->group(function () {
    Route::post('/save', [ComplainantController::class, 'store']);
    Route::get('/show', [ComplainantController::class, 'show']);
});

Route::prefix('public-grievance')->group(function () {
    Route::post('/save', [ComplaintController::class, 'savePublicGrievance']);
});

//Dopor API
Route::prefix('doptor')->group(function () {
    Route::get('/office-layer', [DoptorApiController::class, 'officeLayer']);
    Route::get('/api', [DoptorApiController::class, 'api']);
    Route::get('/office', [DoptorApiController::class, 'office']);
    Route::get('/data', [DoptorApiController::class, 'doptorData']);
    Route::get('/office-organogram', [DoptorApiController::class, 'officeOrganogram']);
});

Route::group(['middleware' => 'auth.jwt'], function () {
    //Dashboard
    Route::prefix('grievance')->group(function () {
        Route::get('/list', [ComplaintController::class, 'index']);
        Route::post('/save', [ComplaintController::class, 'save']);
        Route::get('/details', [ComplaintController::class, 'show']);
        Route::get('/movement', [ComplaintController::class, 'movementHistory']);
        Route::get('/info', [ComplaintController::class, 'info']);
        Route::get('/action-history', [ComplaintController::class, 'actionHistory']);
        Route::post('/rate-us', [ComplaintController::class, 'update']);
    });
    Route::prefix('administrative-grievance')->group(function () {
        Route::get('/movement', [ComplaintMovementController::class,'List']);

    });
    Route::prefix('blacklist')->group(function () {
        Route::get('/index', [BlacklistController::class, 'Index']);
        Route::post('/status/{blacklist_id}', [BlacklistController::class, 'blacklistStatus']);
    });

    Route::prefix('service')->group(function () {
        Route::get('/list', [ServiceController::class, 'index']);
    });

});

