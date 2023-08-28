<?php

use App\Http\Controllers\Api\auth\LoginController;
use App\Http\Controllers\Api\auth\RegistrationController;
use App\Http\Controllers\Api\Verification\VerificationController;
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

Route::post('/registre', [RegistrationController::class, 'registration']);
Route::post('/login', [LoginController::class, 'login']);

Route::prefix('verification')->group(function () {
    Route::post('send', [VerificationController::class, 'send']);
    Route::post('verify', [VerificationController::class, 'verify']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
