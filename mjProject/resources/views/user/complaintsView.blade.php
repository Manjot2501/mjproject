@extends('user.userTemplate')
@section('title', 'MJ User')
@section('content')
    @if (session()->has('success'))
        <div class="col-md-12">
            <div class="alert alert-success text-center mb-5" role="alert">
                {{ Session::get('success') }}
            </div>
        </div>
    @elseif (session()->has('error'))
        <div class="col-md-12">
            <div class="alert alert-danger text-center mb-5" role="alert">
                {{ Session::get('error') }}
            </div>
        </div>
    @endif
    <form action="{{ route('user.action.complaint') }}" method="post">
        <h2 class="mb-4">Register Complaint</h2>
        <div class="form-floating mb-3">
            <select class="form-select" id="floatingSelect" name="department" aria-label="Floating label select example"
                required>
                @if (!empty(count($department)))
                    <option value="">Select Department</option>
                    @foreach ($department as $item)
                        <option value="{{ $item->id }}">{{ $item->department }}</option>
                    @endforeach
                @else
                    <option value="">No Data</option>
                @endif
            </select>
            <label for="floatingSelect">Select Department</label>
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Leave a comment here" name="complaint" id="floatingTextarea"
                required></textarea>
            <label for="floatingTextarea">Complaint</label>
        </div>
        @csrf
        <input type="submit" value="Register" class="mb-3 btn mj-btn-user text-white btn-lg w-100">
    </form>
@endsection
