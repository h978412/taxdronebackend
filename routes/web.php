<?php

use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/buyPlan', [PlanController::class, 'purchasePlan']);


// Route::get('/buyPlans', [PlanController::class, 'test']);

