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
                                <h5 class="nav-tabs-title">Update Courses </h5>

                            </div>
                        </div>
                    </div>
                    <form action=" {{ route('courses.update', $course->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="name" class="sr-only">Courses Name</label>
                                <input type="text" class="form-control" value="{{$course->name}}" id="name" name="name" placeholder="Course Name">
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="name" class="sr-only">Course Detail</label>
                                <textarea name="info" class="form-control" cols="30" rows="8" placeholder="Courses details here">{{$course->info}}</textarea>
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