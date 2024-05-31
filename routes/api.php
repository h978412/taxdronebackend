<?php

use App\Http\Controllers\PlanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::get('/plans', [PlanController::class, 'getPlans']);
Route::get('/plans/{category}', [PlanController::class, 'getPlansForCategory']);
Route::get('/plan/{planId}', [PlanController::class, 'getPlanDetails']);

