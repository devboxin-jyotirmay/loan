<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function index()
    {
        // Check if the authenticated user has the 'admin' role
        if (Gate::denies('admin-role')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Get all loans
        $loans = Loan::all();

        return response()->json(['loans' => $loans]);
    }


    // for laon approve
    public function approveLoan(Request $request, Loan $loan)
    {
        // Check if the authenticated    has the 'admin' role
        if (Gate::denies('admin-role')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Update the loan status to APPROVED
        $loan->update(['status' => 'APPROVED']);

        return response()->json(['message' => 'Loan approved successfully']);
    }
    
    // Loan Creation
    public function createLoan(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'loan_amount' => 'required|numeric|min:1',
            'term' => 'required|integer|min:1',
        ]);

        // Calculate total amount and weekly EMI
        $interest_rate = 8;
        $totalAmount = $validatedData['loan_amount'] + ($validatedData['loan_amount'] * $interest_rate / 100);
        $weeklyEMI = $totalAmount / $validatedData['term'];

        // Create the loan
        $loan = Loan::create([
            'actual_loan' => $validatedData['loan_amount'],
            'total_amount' => $totalAmount,
            'weekly_emi' => $weeklyEMI,
            'term' => $validatedData['term'],
            'users_id' => auth()->user()->id,
            'status' => "pending",
        ]);

        return response()->json(['message' => 'Your Loan Applied', 'loan' => $loan], 201);
    }

    public function showUserLoans(Request $request)
    {
        $user = $request->user(); // Get the authenticated user

        $userLoans = Loan::with(['repayments' => function ($query) use ($user) {
            $query->where('users_id', $user->id);
        }])->where('users_id', $user->id)->get();

        return response()->json(['user_loans' => $userLoans]);
    }
}
