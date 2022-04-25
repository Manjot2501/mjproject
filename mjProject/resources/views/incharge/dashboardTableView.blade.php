
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Complaint</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty(count($report)))
                    @foreach ($report as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ !empty($department[$item->departmentID]) ? $department[$item->departmentID]['department'] : 'NA' }}
                            </td>
                            <td>{{ $item->complaintText }}</td>
                            <td>
                                @if (empty($item->status))
                                    <span class="tag pending">Pending</span>
                                @else
                                    @if ($item->status == 1)
                                        <span class="tag processing">Processing</span>
                                    @else
                                        <span class="tag complete">Complete</span>
                                    @endif
                                @endif
                            </td>
                            <td>{{ date('d-m-y', strtotime($item->created_at)) }}</td>
                            <td data-id="{{ $item->id }}">
                                <button name="" id="" class="btn mj-btn-incharge btn-sm text-white mj-getComplaint"
                                    role="button">
                                    <i class='bx bx-sm bx-edit'></i>
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
    <div class="modal fade" id="editComplaint" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editComplaintlabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editComplaintlabel">Change Complaint Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="editstatusID" name="status"
                                aria-label="Floating label select example">
                                <option value="">Select Status</option>
                                <option value="0">Pending</option>
                                <option value="1">Processing</option>
                                <option value="2">Complete</option>
                            </select>
                            <label for="editstatusID">Status</label>
                        </div>
                    </div>
                    <input type="hidden" name="id" class="editID" value="">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="button" value="Create"
                            class="btn mj-btn-incharge text-white  mj-submit-editStatusComplaint">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('.mj-getComplaint').click(function() {
            let data = {
                id: $(this).parent().attr('data-id'),
                _token: "{{ csrf_token() }}"
            }
            let url = "{{ route('incharge.action.getComplaint') }}";
            __ajax(url, data, function(output) {
                $('#editstatusID').val(output.status)
                $('.editID').val(output.id)
                $('#editComplaint').modal('show');
            }, 1)
        })
        $('.mj-submit-editStatusComplaint').click(function() {
            let data = {
                status: $('#editstatusID').val(),
                id: $('.editID').val(),
                _token: "{{ csrf_token() }}"
            }
            let url = "{{ route('incharge.action.changeStatus') }}";
            __ajax(url, data, function(output) {
                $('.mj-render').html(output.html);
                $('#editComplaint').modal('hide');
                $('.modal-backdrop').hide();
                $('body').removeClass('modal-open')
                $('body').css('overflow', 'auto')
                $('body').css('padding', '0')
            }, 1)
        })
    </script>

