<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoanController;

// <-----------------Customer Routs-------------------->
Route::get('/customer_details', [CustomerController::class, 'customer_details']);
Route::post('/customer_save', [CustomerController::class, 'customer_save']);


// <-----------------Loan Routs-------------------->
// Route::get('/loan_details', [LoanController::class, 'loan_details']);
Route::post('/loan_save', [LoanController::class, 'loan_save']);