<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Validator;

class CustomerController extends Controller
{
    public function customer_save(Request $request){
        $request->validate([
            'name'=>'required',
            'mobile'=>'required|numeric|digits:10',
            'email'=>'required|email',
            'pan_card'=>'required',
            'aadhar_card'=>'required|numeric|digits:12',
            'address'=>'required',
        ]);

        $customer = Customer::create([
            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'pan_card'=>$request->pan_card,
            'aadhar_card'=>$request->aadhar_card,
            'address'=>$request->address,
            
        ]);

        return response([
            'message'=>'Profile Created successfully',
            'status'=>'success',
            'customer'=> $customer
        ], 201);
    }
    public function customer_details(Request $request){
        $customer = Customer::all();
        return response([
            'customer'=>$customer
        ], 200);
    }
}
