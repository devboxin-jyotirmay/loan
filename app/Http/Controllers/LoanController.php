<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Customer;

class LoanController extends Controller
{
    public function loan_save(Request $request){
        $request->validate([
            'loan_amount'=>'required|numeric',
            'annual_income'=>'required|numeric',
            'term'=>'required',
            'customer_id'=>'required',
        ]);
        //dd($request->customer_id);
        // $loan = Loan::create([
        //     'loan_amount'=>$request->loan_amount,
        //     'annual_income'=>$request->annual_income,
        //     'term'=>$request->term,
        //     'customer_id'=>$request->customer_id,

        // ]);

        $loan = new Loan;
        $loan->loan_amount = $request->loan_amount;
        $loan->annual_income = $request->annual_income;
        $loan->term = $request->term;
        $loan->customer_id = $request->customer_id;
        $loan->save();

        return response([
            'message'=>'Loan submitted successfully',
            'status'=>'success',
            'loan'=> $loan
        ], 201);
    }
}
