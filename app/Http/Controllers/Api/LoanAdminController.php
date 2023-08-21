<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Facades\Gate;


class LoanAdminController extends Controller
{

    public function index()
    {
        if (\Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $loans = Loan::all();

        return response()->json(['loans' => $loans]);
    }

    public function approveLoan($loanId)
    {
        if (\Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $loan = Loan::findOrFail($loanId);
        $loan->update(['status' => 'APPROVED']);

        return response()->json(['message' => 'Loan approved successfully']);
    }



    // public function index()
    // {
    //     // Check if the authenticated user has the 'admin' role
    //     if (\Gate::denies('admin-role')) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     // Get all loans
    //     $loans = Loan::all();

    //     return response()->json(['loans' => $loans]);
    // }

    // public function approveLoan(Request $request, $loanId)
    // {
    //     // Check if the authenticated user has the 'admin' role
    //     if (Gate::denies('admin-role')) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     // Find the loan
    //     $loan = Loan::findOrFail($loanId);

    //     // Update the loan status to APPROVED
    //     $loan->update(['status' => 'APPROVED']);

    //     return response()->json(['message' => 'Loan approved successfully']);
    // }
}
