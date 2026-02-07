<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserKyc;
use Illuminate\Http\Request;

class KycController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'aadhaar' => 'required|digits:12',
            'pan' => 'required|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
            'bank_name' => 'required',
            'account_holder' => 'required',
            'account_number' => 'required',
            'ifsc' => 'required|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'id_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'bank_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $kyc = UserKyc::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'aadhaar' => $request->aadhaar,
                'pan' => strtoupper($request->pan),
                'bank_name' => $request->bank_name,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'ifsc' => strtoupper($request->ifsc),
                'id_proof' => $request->file('id_proof')->store('kyc/id'),
                'bank_proof' => $request->file('bank_proof')->store('kyc/bank'),
                'status' => 'pending'
            ]
        );

        return back()->with('success', 'KYC submitted. Waiting for admin approval.');
    }
}
