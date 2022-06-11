@extends('layouts.app')

@section('content')

<div class="content mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ url()->previous() }}" type="button" class="btn btn-warning" data-dismiss="modal">
                    <i class="material-icons">arrow_back</i> Back
                </a>
                <div class="card">
                    <div class="card-header card-header-tabs card-header-primary">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <h5 class="nav-tabs-title">Update attendance </h5>

                            </div>
                        </div>
                    </div>
                    <form action=" {{ route('attendances.update', $attendance->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">

                            <div class="form-group mx-sm-3 mb-2">
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="">--Select Student--</option>
                                    @foreach($users as $user)

                                    <option value="{{$user->id}}" {{ $user->id == $attendance->user_id ? 'selected' : '' }}>{{$user->fname}} {{$user->lname}}</option>

                                    @endforeach
                                </select>
                            </div>
                           
                            <div class="form-group mx-sm-3 mb-2">
                                <select name="status" id="status" class="form-control">
                                    <option value="{{$attendance->status}}">--Select Scored attendance--</option>
                                    <option value="0" {{ $attendance->status == '0' ? 'selected' : '' }}>Absent</option>
                                    <option value="1" {{ $attendance->status == '1' ? 'selected' : '' }}>Present</option>
                                   
                                </select>
                            </div>
                            <div class="form-group mx-sm-3 mb-5">
                                <input type="date" name="date" class="form-control" value="{{ $attendance->date}}">
                            </div>
                         
 
                        </div>
                        <div class="modal-footer">
                            <a href="{{ url()->previous() }}" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
</div>

@endsection