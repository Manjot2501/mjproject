<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty(count($incharge)))
            @foreach ($incharge as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
                <td data-id="{{$item->id}}">
                    <button name="" id="" class="btn btn-primary btn-sm text-white mj-getIncharge" role="button">
                        <i class='bx bx-sm bx-edit'></i>
                    </button>
                    <button name="" id="" class="btn btn-danger btn-sm text-white mj-deleteIncharge" role="button">
                        <i class='bx bx-sm bx-trash'></i>
                    </button>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6">
                    <h4 class="text-center text-danger">No Data</h4>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
<!-- create Modal -->
<div class="modal fade" id="editIncharge" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInchargeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInchargeLabel">Edit Incharge</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="editName" placeholder="Enter Incharge Name..." required>
                        <label for="editName">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="editEmail" placeholder="Incharge Email" required>
                        <label for="editEmail">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="editPassword" placeholder="Password">
                        <label for="editPassword">Password</label>
                    </div>
                </div>
                <input type="hidden" name="id" class="editID" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="button" value="Create" class="btn mj-btn-admin text-white  mj-submit-editIncharge">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('.mj-getIncharge').click(function() {
        let data = {
            id: $(this).parent().attr('data-id'),
            _token: "{{ csrf_token() }}"
        }
        let url = "{{ route('admin.action.getIncharge') }}";
        __ajax(url, data, function(output) {
            $('#editName').val(output.name)
            $('#editEmail').val(output.email)
            $('.editID').val(output.id)
            $('#editPassword').val(output.password)
            $('#editIncharge').modal('show');
        }, 1)
    })

    $('.mj-submit-editIncharge').click(function() {
        $('.alert-danger').addClass('d-none');
        $('.alert-success').addClass('d-none');
        let data = {
            id: $('.editID').val(),
            name: $('#editName').val(),
            email: $('#editEmail').val(),
            password: $('#editPassword').val(),
            _token: "{{ csrf_token() }}"
        }
        let url = "{{ route('admin.action.updateIncharge') }}";
        __ajax(url, data, function(output) {
            if (output.error) {
                $('.alert-danger').removeClass('d-none');
                $('.alert-danger').html(output.error)
            } else {
                $('.mj-render').html(output.html)
                $('.alert-success').removeClass('d-none');
                $('.alert-success').html(output.success)
            }
            $('#editIncharge').modal('hide');
            $('.modal-backdrop').hide();
        }, 1)
    })
    $('.mj-deleteIncharge').click(function() {
        let data = {
            id: $(this).parent().attr('data-id'),
            _token: "{{ csrf_token() }}"
        }
        let url = "{{ route('admin.action.deleteIncharge') }}";
        __ajax(url, data, function(output) {
            $('.mj-render').html(output.html)
        }, 1)
    })
</script>
