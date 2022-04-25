@extends('admin.adminTemplate')
@section('title', 'MJ Admin')
@section('content')
    <div class="col-md-12">
        <div class="alert alert-success text-center mb-5 d-none" role="alert">
        </div>
    </div>
    <div class="col-md-12">
        <div class="alert alert-danger text-center mb-5 d-none" role="alert">
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <h2 class="mb-3">Department List</h2>
        <!-- create Department Button trigger modal -->
        <button type="button" class="btn d-flex btn-sm mj-btn-admin text-white h-100" data-bs-toggle="modal"
            data-bs-target="#createDepartment">
            <i class='bx bx-sm bx-plus-circle me-2'></i> Create
        </button>
    </div>
    <div class="mj-render">
        {!! $html !!}
    </div>
@endsection
