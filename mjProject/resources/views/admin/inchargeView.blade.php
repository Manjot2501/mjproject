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
        <h2 class="mb-3">Incharge List</h2>
        <!-- create incharge Button trigger modal -->
        <button type="button" class="btn d-flex btn-sm mj-btn-admin text-white h-100" data-bs-toggle="modal"
            data-bs-target="#createIncharge">
            <i class='bx bx-sm bx-plus-circle me-2'></i> Create
        </button>
    </div>
    <div class="mj-render">
        {!! $html !!}
    </div>


    <!-- create Modal -->
    <div class="modal fade" id="createIncharge" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="createInchargeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createInchargeLabel">Create Incharge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" id="floatingName"
                                placeholder="Enter Incharge Name..." required>
                            <label for="floatingName">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="floatingEmail"
                                placeholder="Incharge Email" required>
                            <label for="floatingEmail">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" id="floatingPassword"
                                placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="button" value="Create" class="btn mj-btn-admin text-white  mj-submit-newIncharge">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('docuemnt').ready(function() {
            $('.mj-submit-newIncharge').click(function() {
                $('.alert-danger').addClass('d-none');
                $('.alert-success').addClass('d-none');
                let data = {
                    name: $('#floatingName').val(),
                    email: $('#floatingEmail').val(),
                    password: $('#floatingPassword').val(),
                    _token: "{{ csrf_token() }}"
                }
                let url = "{{ route('admin.action.createIncharge') }}";
                __ajax(url, data, function(output) {
                    if(output.error){
                        $('.alert-danger').removeClass('d-none');
                        $('.alert-danger').html(output.error)
                    }else{
                        $('.mj-render').html(output.html)
                        $('.alert-success').removeClass('d-none');
                        $('.alert-success').html(output.success)
                    }
                    $('#createIncharge').modal('hide')
                },1)
            })
        })
    </script>
@endsection
