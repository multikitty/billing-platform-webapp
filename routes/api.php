<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\MemberController;
use App\Http\Controllers\api\SettingController;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
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

// auth
Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

Route::middleware('auth.jwt')->group(function() {

    // setting
    Route::prefix('/setting')->group(function() {
        Route::get('', [SettingController::class, 'indexPracticeSetting']);
        Route::post('', [SettingController::class, 'savePracticeSetting']);
        Route::post('logo/update', [SettingController::class, 'updatePracticeSettingLogo']);
        Route::post('create/additional_setting', [SettingController::class, 'createPracticeAdditionalSetting']);
        Route::delete('delete/additional_setting/{id}', [SettingController::class, 'deletePracticeAdditionalSetting']);
    });

    // member
    Route::prefix('/member')->group(function() {
        Route::get('', [MemberController::class, 'getTeamMembers']);
        Route::post('', [MemberController::class, 'createTeamMember']);
        Route::post('/{id}', [MemberController::class, 'updateTeamMember']);
    });

});

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});
