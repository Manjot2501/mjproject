@extends('incharge.inchargeTemplate')
@section('title', 'MJ Incharge')
@section('content')
    @if (session()->has('success'))
        <div class="col-md-12">
            <div class="alert alert-success text-center mb-5" role="alert">
                {{ Session::get('success') }}
            </div>
        </div>
    @elseif (session()->has('error'))
        <div class="col-md-12">
            <div class="alert alert-danger text-center mb-5" role="alert">
                {{ Session::get('error') }}
            </div>
        </div>
    @endif
    <form action="{{ route('incharge.action.changePassword') }}" method="post">
        <h2 class="mb-4">Change Password</h2>
        <div class="form-floating mb-3">
            <input type="Password" class="form-control" name="oldPassword" id="floatingInput" placeholder="Old Password"
                required>
            <label for="floatingPassword">Old Password</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="newPassword" id="floatingNewPassword"
                placeholder="New Password" required>
            <label for="floatingNewPassword">New Password</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="confirmPassword" id="floatingConfirmPassword"
                placeholder="Confirm Password" required>
            <label for="floatingConfirmPassword">Confirm Password</label>
        </div>
        @csrf
        <input type="submit" value="Change Password" class="mb-3 btn mj-btn-incharge text-white btn-lg w-100">
    </form>
@endsection
