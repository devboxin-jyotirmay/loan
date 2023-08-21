<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Repayment;
use App\Models\Loan;

class RepaymentController extends Controller
{
    public function createRepayment(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'loan_id' => 'required|exists:loans,id',
            'amount' => 'required',
        ]);


        // Find the authenticated user
        $user = $request->user();

        // Check if the authenticated user matches the requested user
        if ($user->id !== (int)$validatedData['user_id']) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

         // Find the loan
         $loan = Loan::where('users_id', $validatedData['user_id'])->findOrFail($validatedData['loan_id']);

         // Check if the loan is approved by an admin
         if ($loan->status !== 'APPROVED') {
             return response()->json(['error' => 'Loan is not approved yet'], 400);
         }

        $repayment = new Repayment;
        $repayment->repayment_amount = $validatedData['amount']; 
        $repayment->loan_id = $validatedData['loan_id'];
        $repayment->users_id = $validatedData['user_id'];
        $repayment->status = "Paid";
        $repayment->save();
        return response()->json(['message' => 'Your payment Submited']);
    }
}
