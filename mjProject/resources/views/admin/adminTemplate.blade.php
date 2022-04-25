@extends('template')
@section('title','MJ Project')
@section('css')
<style>
    :root{
        --theme:var(--admin);
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
    <h3>MJ Admin</h3>
</header>
<aside>
    <div class="mj-aside-header">
        MJ
    </div>
    <ul>
        <li><a href="{{route('admin.dashboard')}}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard"><i class='bx bx-sm bxs-dashboard text-white'></i></a></li>
        <li><a href="{{route('admin.incharge')}}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Incharge"><i class='bx bx-sm bx-user text-white'></i></a></li>
        <li><a href="{{route('admin.department')}}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Department"><i class='bx bx-sm bx-sitemap text-white'></i></a></li>
        <li><a href="{{route('admin.complaints')}}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Complaint"><i class='bx bx-sm bx-user-voice text-white'></i></a></li>
        <li><a href="{{route('admin.changePassword')}}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Change Password"><i class='bx bx-sm bx-cog text-white'></i></a></li>
        <li><a href="{{route('admin.action.logout')}}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Logout"><i class='bx bx-sm bx-log-out-circle text-white'></i></a></li>
    </ul>
</aside>
<main>
    <div class="content">
       @yield('content')
    </div>
</main>
<footer>© 2021 Copyright: MJ-Project.com</footer>
@endsection
