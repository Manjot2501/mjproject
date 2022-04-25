@extends('template')
@section('title','MJ User')
@section('css')
<style>
    :root{
        --theme:var(--user);
    }
</style>
@endsection
@section('main')
<div class="mj-loading" style="display:none">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
</div>
<header>
    <h3>MJ User</h3>
</header>
<aside>
    <div class="mj-aside-header">
        MJ
    </div>
    <ul>
        <li><a href="{{route('user.dashboard')}}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard"><i class='bx bx-sm bxs-dashboard text-white'></i></a></li>
        <li><a href="{{route('user.complaint')}}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Complaint"><i class='bx bx-sm bx-user-voice text-white'></i></a></li>
        <li><a href="{{route('user.changePassword')}}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Change Password"><i class='bx bx-sm bx-cog text-white'></i></a></li>
        <li><a href="{{route('user.action.logout')}}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Logout"><i class='bx bx-sm bx-log-out-circle text-white'></i></a></li>
    </ul>
</aside>
<main>
    <div class="content">
       @yield('content')
    </div>
</main>
<footer>© 2021 Copyright: MJ-Project.com</footer>
@endsection
