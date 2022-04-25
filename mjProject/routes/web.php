<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\inchargeController;
use App\Http\Controllers\userController;
use App\Models\incharge;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/admin-login', function () {
    return view('admin.adminLogin');
})->name('admin-login');
Route::post('/admin-login', [adminController::class, 'loginAction'])->name('admin.action.login');

Route::get('/incharge-login', function () {
    return view('incharge.inchargeLogin');
})->name('incharge-login');
Route::post('/incharge-login', [inchargeController::class, 'loginAction'])->name('incharge.action.login');

Route::get('/user-login', function () {
    return view('user.userLogin');
})->name('user-login');
Route::post('/user-login', [userController::class, 'loginAction'])->name('user.action.login');


Route::group(['prefix' => 'admin', 'middleware' => ['adminAuth']], function () {
    Route::get('dashboard', [adminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('incharge', [adminController::class, 'incharge'])->name('admin.incharge');
    Route::post('create-incharge', [adminController::class, 'createIncharge'])->name('admin.action.createIncharge');
    Route::post('get-incharge', [adminController::class, 'getIncharge'])->name('admin.action.getIncharge');
    Route::post('update-incharge', [adminController::class, 'updateIncharge'])->name('admin.action.updateIncharge');
    Route::post('delete-incharge', [adminController::class, 'deleteIncharge'])->name('admin.action.deleteIncharge');

    Route::get('department', [adminController::class, 'department'])->name('admin.department');
    Route::post('create-department', [adminController::class, 'createDepartment'])->name('admin.action.createDepartment');
    Route::post('get-department', [adminController::class, 'getDepartment'])->name('admin.action.getDepartment');
    Route::post('update-department', [adminController::class, 'updateDepartment'])->name('admin.action.updateDepartment');
    Route::post('delete-department', [adminController::class, 'deleteDepartment'])->name('admin.action.deleteDepartment');

    Route::get('complaints', [adminController::class, 'complaints'])->name('admin.complaints');

    Route::get('change-password', function () {
        return view('admin.changePasswordView');
    })->name('admin.changePassword');
    Route::post('change-password', [adminController::class, 'changePassword'])->name('admin.action.changePassword');

    Route::get('logout', [adminController::class, 'logout'])->name('admin.action.logout');
});
Route::group(['prefix' => 'incharge', 'middleware' => ['inchargeAuth']], function () {
    Route::get('dashboard', [inchargeController::class, 'dashboard'])->name('incharge.dashboard');
    Route::post('getcomplaint', [inchargeController::class, 'getComplaint'])->name('incharge.action.getComplaint');
    Route::post('changeStatus', [inchargeController::class, 'changeStatus'])->name('incharge.action.changeStatus');

    Route::get('change-password', function () {
        return view('incharge.changePasswordView');
    })->name('incharge.changePassword');
    Route::post('change-password', [inchargeController::class, 'changePassword'])->name('incharge.action.changePassword');

    Route::get('logout', [inchargeController::class, 'logout'])->name('incharge.action.logout');
});

Route::group(['prefix' => 'user', 'middleware' => ['userAuth']], function () {
    Route::get('dashboard', [userController::class, 'dashboard'])->name('user.dashboard');

    Route::get('complaint', [userController::class, 'complaintView'])->name('user.complaint');
    Route::post('complaint', [userController::class, 'complaintRegister'])->name('user.action.complaint');

    Route::get('change-password', function () {
        return view('user.changePasswordView');
    })->name('user.changePassword');
    Route::post('change-password', [userController::class, 'changePassword'])->name('user.action.changePassword');

    Route::get('logout', [userController::class, 'logout'])->name('user.action.logout');
});
