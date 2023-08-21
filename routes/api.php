<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LoanController;
use App\Http\Controllers\Api\RepaymentController;
use App\Http\Controllers\Api\LoanAdminController;

// <-----------------Public Routes-------------------->
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
//dd('ddd');
// <-----------------Admin Routes-------------------->
Route::middleware(['auth:api'])->group(function () {
    Route::get('admin/loans', [LoanAdminController::class, 'index']);
    Route::put('admin/loans/{loanId}/approve', [LoanAdminController::class,'approveLoan']);
});

Route::middleware('auth:api')->group(function() {
    
    // <-----------------Loan Routs-------------------->
    Route::get('user/loans', [LoanController::class,'showUserLoans'] );
    Route::post('createloan', [LoanController::class, 'createLoan']);
    
    // <-----------------Repayments Routs-------------------->
    Route::post('users/repayments', [RepaymentController::class,'createRepayment']);
    
});

