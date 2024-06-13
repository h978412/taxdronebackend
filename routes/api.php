<?php

use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::get('/validateToken', [UserController::class, 'validateToken'])->middleware('auth:sanctum');
Route::get('/myPlans', [PlanController::class, 'getPlans']);

Route::get('/plans', [PlanController::class, 'getPlans']);
Route::get('/plans/{category}', [PlanController::class, 'getPlansForCategory']);
Route::get('/plan/{planId}', [PlanController::class, 'getPlanDetails']);
Route::get('/payment', [PlanController::class, 'createOrder']);

Route::post('/buyPlan', [PlanController::class, 'purchasePlan']);

Route::post('/raiseEnquiry', [EnquiryController::class, 'raiseCallBackEnquiry']);