<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Lib\FormProcessor;
use Illuminate\Http\Request;
use App\Models\UserKyc;
use App\Models\User;

class KycController extends Controller
{
    public function setting()
    {
        $pageTitle = 'KYC Setting';
        $form = Form::where('act', 'kyc')->first();
        return view('admin.kyc.setting', compact('pageTitle', 'form'));
    }
    public function index()
    {
        $kycs = \App\Models\UserKyc::latest()->get();
        return view('admin.kyc.index', compact('kycs'));
    }

    // List pending KYC
    public function pending()
    {
        $pageTitle = 'Pending KYC Verifications';

        $kycs = UserKyc::with('user')
            ->where('status', 'pending')
            ->latest()
            ->paginate(20);

        return view('admin.kyc.pending', compact('pageTitle', 'kycs'));
    }

    // View full KYC details
    public function show($id)
    {
        $pageTitle = 'KYC Details';

        $kyc = \App\Models\UserKyc::with('user')->findOrFail($id);

        return view('admin.kyc.show', compact('pageTitle', 'kyc'));
    }

    // Approve
    public function approve($id)
    {
        UserKyc::where('id', $id)->update(['status' => 'approved']);

        return redirect()->route('admin.kyc.pending')
            ->with('success', 'KYC Approved Successfully');
    }

    // Reject
    public function reject(Request $request, $id)
    {
        $request->validate(['remark' => 'required']);

        UserKyc::where('id', $id)->update([
            'status' => 'rejected',
            'admin_remark' => $request->remark
        ]);

        return redirect()->route('admin.kyc.pending')
            ->with('error', 'KYC Rejected');
    }


    public function settingUpdate(Request $request)
    {
        $formProcessor = new FormProcessor();
        $generatorValidation = $formProcessor->generatorValidation();
        $request->validate($generatorValidation['rules'], $generatorValidation['messages']);
        $exist = Form::where('act', 'kyc')->first();
        $formProcessor->generate('kyc', $exist, 'act');

        $notify[] = ['success', 'KYC data updated successfully'];
        return back()->withNotify($notify);
    }
}
