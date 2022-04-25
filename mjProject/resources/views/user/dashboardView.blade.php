@extends('user.userTemplate')
@section('title','MJ User')
@section('content')


<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Department</th>
                <th>Complaint</th>
                <th>Status</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty(count($report)))
            @foreach ($report as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ !empty($department[$item->departmentID])?$department[$item->departmentID]['department']:'NA' }}</td>
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
                <td>{{ $item->created_at }}</td>
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

@endsection
