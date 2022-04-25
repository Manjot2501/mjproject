@extends('template')
@section('title','MJ Project')
@section('main')
<div class="align-items-md-center d-flex mj-vh-100">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-5 mt-5 mt-md-0">
                <div class="mj-card mj-admin  px-4 py-2 bg-white">
                    <a href="{{route('admin-login')}}" class="text-decoration-none text-black-50">
                        <h4 class="m-0 py-2  text-center">Admin</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-5">
                <div class="mj-card mj-incharge  px-4 py-2 bg-white">
                    <a href="{{route('incharge-login')}}" class="text-decoration-none text-black-50">
                        <h4 class="m-0 py-2 shadow text-center">Incharge</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-5">
                <div class="mj-card mj-user  px-4 py-2 bg-white">
                    <a href="{{route('user-login')}}" class="text-decoration-none text-black-50">
                        <h4 class="m-0 py-2 shadow text-center">User</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
