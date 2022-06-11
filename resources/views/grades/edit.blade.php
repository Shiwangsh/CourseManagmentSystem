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
                                <h5 class="nav-tabs-title">Update Grade </h5>

                            </div>
                        </div>
                    </div>
                    <form action=" {{ route('grades.update', $grade->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">

                            <div class="form-group mx-sm-3 mb-2">
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="">--Select Student--</option>
                                    @foreach($users as $user)

                                    <option value="{{$user->id}}" {{ $user->id == $grade->user_id ? 'selected' : '' }}>{{$user->fname}} {{$user->lname}}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <select name="assignment_id" id="assignment_id" class="form-control">
                                    <option value="">--Select Assignment--</option>
                                    @foreach($assignments as $assignment)
                                    <option value="{{$assignment->id}}" {{ $grade->assignment_id == $assignment->id ? 'selected' : '' }}>{{$assignment->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <select name="scored_grade" id="scored_grade" class="form-control">
                                    <option value="{{$grade->scored_grade}}">--Select Scored Grade--</option>
                                    <option value="A" {{ $grade->scored_grade == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="A-" {{ $grade->scored_grade == 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ $grade->scored_grade == 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B" {{ $grade->scored_grade == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="B-" {{ $grade->scored_grade == 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="C+" {{ $grade->scored_grade == 'C+' ? 'selected' : '' }}>C+</option>
                                    <option value="C" {{ $grade->scored_grade == 'C' ? 'selected' : '' }}>C</option>
                                    <option value="C-" {{ $grade->scored_grade == 'C-' ? 'selected' : '' }}>C-</option>
                                    <option value="D+" {{ $grade->scored_grade == 'D+' ? 'selected' : '' }}>D+</option>
                                    <option value="D" {{ $grade->scored_grade == 'D' ? 'selected' : '' }}>D</option>
                                    <option value="F" {{ $grade->scored_grade == 'F' ? 'selected' : '' }}>F</option>
                                </select>
                            </div>
                            <div class="form-group mx-sm-3 mb-5">
                                <input type="file" name="file" class="form-control custom-file-input" id="validatedCustomFile">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <textarea name="remarks" class="form-control" cols="20" rows="3" placeholder="Add remarks">{{$grade->remarks}}</textarea>
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