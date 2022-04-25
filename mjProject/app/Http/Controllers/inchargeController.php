<?php

namespace App\Http\Controllers;

use App\Models\complaint;
use App\Models\department;
use App\Models\incharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class inchargeController extends Controller
{
    /*
    * incharge login action
    */
    public function loginAction(Request $request)
    {
        $message = ['error' => "Email ID and password can't be empty !!!"];
        if (!empty($request->input('email')) && !empty($request->input('password'))) {
            $message = ['error' => "Email ID not exist !!!"];
            if (incharge::where('email', $request->input('email'))->exists()) {
                $incharge = incharge::where('email', $request->input('email'))->first();
                $message = ['error' => "Check Your password !!!"];
                if (Hash::check($request->input('password'), $incharge->password)) {
                    $request->session()->put('inchargeID', $incharge->id);
                    return redirect()->route('incharge.dashboard');
                }
            }
        }
        return redirect()->route('incharge-login')->with($message);
    }

    /*
    * incharge logout action
    */
    public function logout(Request $request)
    {
        $request->session()->pull('inchargeID');
        return redirect()->route('incharge-login');
    }

/*
    * incharge complaint tableview
    */
    public function complaintTable()
    {
        $data['department'] = department::where('inchargeID', session()->get('inchargeID'))->get()->keyBy('id')->toArray();
        $departmentKeys = array_keys($data['department']);

        $data['report'] = complaint::whereIn('departmentID', $departmentKeys)->get();
        return view('incharge.dashboardTableView', $data)->render();
    }
    /*
    * incharge dashboard view
    */
    public function dashboard(Request $request)
    {
        $data['html'] = $this->complaintTable();
        return view('incharge.dashboardView', $data);
    }

    /*
    * incharge get complaint details
    */
    public function getComplaint(Request $request)
    {
        return complaint::find($request->input('id'));
    }

     /*
    * incharge update  complaint status
    */
    public function changeStatus(Request $request)
    {
        $complaint = complaint::find($request->input('id'))->first();
        $complaint->status = $request->input('status');
        $complaint->save();
        return ['success' => "Complaint Status successfully update !!!",'html'=>$this->complaintTable()];
    }

    /*
    * incharge change password
    */
    public function changePassword(Request $request)
    {
        // validate incoming request
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required'
        ]);
        if ($validator->fails()) {
            $message = ['error' => "kindly fill all the field !!!"];
        }
        if ($request->input('newPassword') == $request->input('confirmPassword')) {
            $incharge = incharge::find($request->session()->get('inchargeID'))->first();
            $message = ['error' => 'Old password not match !!!'];
            if (Hash::check($request->input('oldPassword'), $incharge->password)) {
                $incharge->password = Hash::make($request->input('newPassword'));
                $incharge->save();
                $message = ['success' => 'Successfully Change Password !!!'];
            }
        } else {
            $message = ['error' => 'New password and Confirm password not match !!!'];
        }
        return redirect()->route('incharge.changePassword')->with($message);
    }
}
