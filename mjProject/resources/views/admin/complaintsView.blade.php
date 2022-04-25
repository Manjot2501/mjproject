@extends('admin.adminTemplate')
@section('title','MJ Admin')
@section('content')
<h2 class="mb-3">Complaint List</h2>
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
            </tr>
        </thead>
        <tbody>
            @if (!empty(count($complaints)))
            @foreach ($complaints as $item)
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
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5">
                    <h4 class="text-center text-danger">No Data</h4>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
