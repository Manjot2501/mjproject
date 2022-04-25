<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\complaint;
use App\Models\department;
use App\Models\incharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class adminController extends Controller
{
    /*
    * admin login action
    */
    public function loginAction(Request $request)
    {
        $message = ['error' => "Email ID and password can't be empty !!!"];
        if (!empty($request->input('email')) && !empty($request->input('password'))) {
            $message = ['error' => "Email ID not exist !!!"];
            if (admin::where('email', $request->input('email'))->exists()) {
                $admin = admin::where('email', $request->input('email'))->first();
                $message = ['error' => "Check Your password !!!"];
                if (Hash::check($request->input('password'), $admin->password)) {
                    $request->session()->put('adminID', $admin->id);
                    return redirect()->route('admin.dashboard');
                }
            }
        }
        return redirect()->route('admin-login')->with($message);
    }

    /*
    * admin logout action
    */
    public function logout(Request $request)
    {
        $request->session()->pull('adminID');
        return redirect()->route('admin-login');
    }

    /*
    * admin Dashboard
    */
    public function dashboard()
    {
        $data['complaints'] = complaint::where('status',0)->get();
        $data['department'] = department::all();
        return view('admin.dashboardView',$data);
    }

    /*
    * admin change password
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
            $admin = admin::find($request->session()->get('adminID'))->first();
            $message = ['error' => 'Old password not match !!!'];
            if (Hash::check($request->input('oldPassword'), $admin->password)) {
                $admin->password = Hash::make($request->input('newPassword'));
                $admin->save();
                $message = ['success' => 'Successfully Change Password !!!'];
            }
        } else {
            $message = ['error' => 'New password and Confirm password not match !!!'];
        }
        return redirect()->route('admin.changePassword')->with($message);
    }

    /*
    * admin incharge tableview
    */
    public function inchargeTableView()
    {
        $data['incharge'] = incharge::all();
        return view('admin.inchargeTableView', $data)->render();
    }

    /*
    * admin incharge view
    */
    public function incharge()
    {
        $data['html'] = $this->inchargeTableView();
        return view('admin.inchargeView', $data);
    }

    /*
    * admin get incharge info
    */
    public function getincharge(Request $request)
    {
        return incharge::find($request->input('id'));
    }

    /*
    * admin delete incharge
    */
    public function deleteIncharge(Request $request)
    {
        $incharge = incharge::find($request->input('id'));
        $incharge->delete();
        return ['id' => $incharge->id, 'message' => 'successfully delete !!!', 'html' => $this->inchargeTableView()];
    }

    /*
    * admin update incharge
    */
    public function updateIncharge(Request $request)
    {
        // validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            $message = ['error' => "kindly fill all the field !!!"];
        } else {
            if (incharge::where('email', $request->input('email'))->exists()) {
                $message = ['error' => "Email is Already register !!!"];
            } else {
                $incharge = incharge::find($request->input('id'));
                $incharge->name = ucwords($request->input('name'));
                $incharge->email = $request->input('email');
                if (!empty($request->input('password'))) {
                    $incharge->password = Hash::make($request->input('password'));
                } else {
                    $incharge->password = $incharge->password;
                }
                $incharge->save();
                $message = ['success' => "Incharge successfully update !!!"];
                $message['html'] = $this->inchargeTableView();
            }
        }
        return $message;
    }

    /*
    * admin create incharge
    */
    public function createIncharge(Request $request)
    {
        // validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            $message = ['error' => "kindly fill all the field !!!"];
        } else {
            if (incharge::where('email', $request->input('email'))->exists()) {
                $message = ['error' => "Email is Already register !!!"];
            } else {
                $incharge = new incharge;
                $incharge->name = ucwords($request->input('name'));
                $incharge->email = $request->input('email');
                $incharge->password = Hash::make($request->input('password'));
                $incharge->save();
                $message = ['success' => "Incharge successfully save !!!"];
                $message['html'] = $this->inchargeTableView();
            }
        }
        return $message;
    }

    /*
    * admin department tableview
    */
    public function departmentTableView()
    {
        $data['department'] = department::all();
        $data['incharge'] = incharge::all()->keyBy('id');
        return view('admin.departmentTableView', $data)->render();
    }

    /*
    * admin department view
    */
    public function department()
    {
        $data['html'] = $this->departmentTableView();
        return view('admin.departmentView', $data);
    }

    /*
    * admin get department info
    */
    public function getdepartment(Request $request)
    {
        return department::find($request->input('id'));
    }

    /*
    * admin delete department
    */
    public function deleteDepartment(Request $request)
    {
        $department = department::find($request->input('id'));
        $department->delete();
        return ['id' => $department->id, 'message' => 'successfully delete !!!', 'html' => $this->departmentTableView()];
    }

    /*
    * admin update department
    */
    public function updateDepartment(Request $request)
    {
        // validate incoming request
        $validator = Validator::make($request->all(), [
            'department' => 'required',
        ]);
        if ($validator->fails()) {
            $message = ['error' => "kindly fill all the field !!!"];
        } else {
            $department = department::find($request->input('id'));
            $department->department = ucwords($request->input('department'));
            $department->inchargeID = $request->input('inchargeID') ?? Null;
            $department->save();
            $message = ['success' => "Department successfully update !!!"];
            $message['html'] = $this->departmentTableView();
        }
        return $message;
    }

    /*
    * admin create department
    */
    public function createDepartment(Request $request)
    {
        // validate incoming request
        $validator = Validator::make($request->all(), [
            'department' => 'required',
        ]);
        if ($validator->fails()) {
            $message = ['error' => "kindly fill all the field !!!"];
        } else {
            if (department::where('department', $request->input('department'))->exists()) {
                $message = ['error' => "Department is Already register !!!"];
            } else {
                $department = new department;
                $department->department = ucwords($request->input('department'));
                $department->inchargeID = $request->input('inchargeID') ?? Null;
                $department->save();
                $message = ['success' => "Department successfully save !!!"];
                $message['html'] = $this->departmentTableView();
            }
        }
        return $message;
    }

    /*
    * admin complaint view
    */
    public function complaints()
    {
        $data['complaints'] = complaint::all();
        $data['department'] = department::all();
        return view('admin.complaintsView',$data);
    }
}
