<?php

namespace App\Http\Controllers;

use App\Models\complaint;
use App\Models\department;
use App\Models\webUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    /*
    * user login action
    */
    public function loginAction(Request $request)
    {
        $message = ['error' => "Email ID and password can't be empty !!!"];
        if (!empty($request->input('email')) && !empty($request->input('password'))) {
            $message = ['error' => "Email ID not exist !!!"];
            if (webUser::where('email', $request->input('email'))->exists()) {
                $user = webUser::where('email', $request->input('email'))->first();
                $message = ['error' => "Check Your password !!!"];
                if (Hash::check($request->input('password'), $user->password)) {
                    $request->session()->put('userID', $user->id);
                    return redirect()->route('user.dashboard');
                }
            }
        }
        return redirect()->route('user-login')->with($message);
    }


    /*
    * user logout action
    */
    public function logout(Request $request)
    {
        $request->session()->pull('userID');
        return redirect()->route('user-login');
    }

    /*
    * user change password
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
            $user = webUser::find($request->session()->get('userID'))->first();
            $message = ['error' => 'Old password not match !!!'];
            if (Hash::check($request->input('oldPassword'), $user->password)) {
                $user->password = Hash::make($request->input('newPassword'));
                $user->save();
                $message = ['success' => 'Successfully Change Password !!!'];
            }
        } else {
            $message = ['error' => 'New password and Confirm password not match !!!'];
        }
        return redirect()->route('user.changePassword')->with($message);
    }


    /*
    * user complaint view
    */
    public function complaintView()
    {
        $data['department'] = department::join('incharge', 'departments.inchargeID', '=', 'incharge.id')->get(['departments.department', 'departments.id', 'incharge.name', 'incharge.email']);
        return view('user.complaintsView', $data);
    }

    /*
    * user complaint register
    */
    public function complaintRegister(Request $request)
    {
        // validate incoming request
        $validator = Validator::make($request->all(), [
            'department' => 'required',
            'complaint' => 'required',
        ]);
        if ($validator->fails()) {
            $message = ['error' => "kindly fill all the field !!!"];
        } else {
            $user = webUser::find($request->session()->get('userID'))->first();
            $complaint = new complaint;
            $complaint->email = $user->email;
            $complaint->departmentID = $request->input('department');
            $complaint->complaintText = $request->input('complaint');
            $complaint->status = 0;
            $complaint->save();
            $message = ['success' => 'Successfully register your complaint !!!'];
        }
        return redirect()->route('user.complaint')->with($message);
    }

     /*
    * user dashboard view
    */
    public function dashboard(Request $request)
    {
        $user = webUser::find($request->session()->get('userID'))->first();
        $data['report'] = complaint::where('email',$user->email)->get();
        $data['department'] = department::all()->keyBy('id');
        return view('user.dashboardView', $data);
    }
}
