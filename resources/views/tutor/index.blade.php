@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="green">Your courses</h3>
    <div class="row">
        @foreach($courses as $course)
        <div class="col-md-4">
            <div class="card card-chart">
                <div class="card-header card-header-success">
                    <h4>{{$course->name}}</h4>
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{Str::limit($course->info,100)}}</h4>
                    <p class="card-category">
                        <a href="{{route('courses.show',$course->slug)}}" class="btn btn-success btn-sm text-center"> View More</a>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i> {{$course->updated_at->diffforhumans()}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection