@extends('template')
@section('title', 'User Login')
@section('css')
<style>
    :root{
        --theme:var(--user);
    }
</style>
@endsection
@section('main')
    <div class="align-items-center d-flex mj-vh-100">
        <div class="container">
            <div class="row">
                @if (session()->has('error'))
                    <div class="col-md-12">
                        <div class="alert alert-danger text-center mb-5" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    </div>
                @endif
                <div class="col-md-6 d-none d-md-block">
                    <div class="  px-4 py-2">
                        <img src="{{ URL::to('assets/img/user-login.svg') }}" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6 mt-5 mt-md-0">
                    <div class="mj-card mj-user  px-4 py-2 bg-white">
                        <h4 class="m-0 py-2  text-center">User Login</h4>
                        <form method="post" action="{{route('user.action.login')}}">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="floatingInput"
                                    placeholder="name@example.com" required>
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                                <label for="floatingPassword">Password</label>
                            </div>
                            @csrf
                            <input type="submit" value="Login" class="btn btn-lg btn-primary w-100 mb-3 mj-btn-user">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
