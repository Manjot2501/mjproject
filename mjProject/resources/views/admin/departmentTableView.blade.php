<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Incharge</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty(count($department)))
                @foreach ($department as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->department }}</td>
                        <td>{{ isset($incharge[$item->inchargeID]) ? $incharge[$item->inchargeID]['name'] :  'NA' }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td data-id="{{ $item->id }}">
                            <button name="" id="" class="btn btn-primary btn-sm text-white mj-getDepartment"
                                role="button">
                                <i class='bx bx-sm bx-edit'></i>
                            </button>
                            <button name="" id="" class="btn btn-danger btn-sm text-white mj-deleteDepartment"
                                role="button">
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
<!-- edit Modal -->
<div class="modal fade" id="editDepartment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editDepartmentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDepartmentLabel">Edit Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="department" id="editDepartmentName"
                            placeholder="Enter Department Name..." required>
                        <label for="editDepartmentName">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="editInchargeID" name="editInchargeID"
                            aria-label="Floating label select example">
                            @if (!empty(count($incharge)))
                                <option value="">Select Incharge</option>
                                @foreach ($incharge as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            @else
                                <option value="">No Data</option>
                            @endif
                        </select>
                        <label for="editInchargeID">Assign Incharge</label>
                    </div>
                </div>
                <input type="hidden" name="id" class="editID" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="button" value="Create" class="btn mj-btn-admin text-white  mj-submit-editDepartment">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- create Modal -->
<div class="modal fade" id="createDepartment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="createDepartmentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDepartmentLabel">Create Department</h5>
                <button type="button" class="btn-close mj-createDepartment-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="department" id="floatingName"
                            placeholder="Enter Department Name..." required>
                        <label for="floatingName">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" name="inchargeID"
                            aria-label="Floating label select example">
                            @if (!empty(count($incharge)))
                                <option value="">Select Incharge</option>
                                @foreach ($incharge as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            @else
                                <option value="">No Data</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Assign Incharge</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="button" value="Create" class="btn mj-btn-admin text-white  mj-submit-newDepartment">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('.mj-submit-newDepartment').click(function() {
        $('.alert-danger').addClass('d-none');
        $('.alert-success').addClass('d-none');
        let data = {
            department: $('#floatingName').val(),
            inchargeID: $('#floatingSelect').val(),
            _token: "{{ csrf_token() }}"
        }
        let url = "{{ route('admin.action.createDepartment') }}";
        __ajax(url, data, function(output) {
            if (output.error) {
                $('.alert-danger').removeClass('d-none');
                $('.alert-danger').html(output.error)
            } else {
                $('.mj-render').html(output.html)
                $('.alert-success').removeClass('d-none');
                $('.alert-success').html(output.success)
            }
            $('.mj-createDepartment-btn').click();
            $('.modal-backdrop').hide();
            $('body').removeClass('modal-open')
            $('body').css('overflow', 'auto')
            $('body').css('padding', '0')
        }, 1)
    })
    $('.mj-getDepartment').click(function() {
        let data = {
            id: $(this).parent().attr('data-id'),
            _token: "{{ csrf_token() }}"
        }
        let url = "{{ route('admin.action.getDepartment') }}";
        __ajax(url, data, function(output) {
            $('#editDepartmentName').val(output.department)
            $('#editInchargeID').val(output.inchargeID)
            $('.editID').val(output.id)
            $('#editDepartment').modal('show');
        }, 1)
    })

    $('.mj-submit-editDepartment').click(function() {
        $('.alert-danger').addClass('d-none');
        $('.alert-success').addClass('d-none');
        let data = {
            id: $('.editID').val(),
            department: $('#editDepartmentName').val(),
            inchargeID: $('#editInchargeID').val(),
            _token: "{{ csrf_token() }}"
        }
        let url = "{{ route('admin.action.updateDepartment') }}";
        __ajax(url, data, function(output) {
            if (output.error) {
                $('.alert-danger').removeClass('d-none');
                $('.alert-danger').html(output.error)
            } else {
                $('.mj-render').html(output.html)
                $('.alert-success').removeClass('d-none');
                $('.alert-success').html(output.success)
            }
            $('#editDepartment').modal('hide');
            $('.modal-backdrop').hide();
            $('body').removeClass('modal-open')
            $('body').css('overflow', 'auto')
            $('body').css('padding', '0')
        }, 1)
    })
    $('.mj-deleteDepartment').click(function() {
        let data = {
            id: $(this).parent().attr('data-id'),
            _token: "{{ csrf_token() }}"
        }
        let url = "{{ route('admin.action.deleteDepartment') }}";
        __ajax(url, data, function(output) {
            $('.mj-render').html(output.html)
        }, 1)
    })
</script>
