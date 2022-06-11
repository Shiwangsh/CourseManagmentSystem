@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="green">Available Courses</h3>
   
    <div class="row">
        @foreach($courses as $course)
        <div class="col-md-4">
            <div class="card card-chart">
                <div class="card-header card-header-success">
                    <h4>{{$course->name}}</h4>
                    
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{Str::limit($course->info,100)}}</h4>
                    <p class="card-category ">
                    <div class="form-inline">
                     <a href="{{route('courses.show',$course->slug)}}" class="btn btn-success btn-sm text-center"> View More</a>
                             @if(!$course->checkEnrollment())

                        <form action="{{route('courses.enroll')}}" method="post"  >
                        @csrf
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        <button type="submit" class="btn btn-primary btn-sm text-right">Enroll Now</button>

                        </form>
                        @endif
                    </div>
                       
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i> {{$course->updated_at->diffforhumans()}} &nbsp; &nbsp; &nbsp; &nbsp;
                        <i class="material-icons red">access_time</i> <p class="red">Already Enrolled</p>
                    </div>
                </div>
            </div>
        </div>
       
        @endforeach

    </div>
</div>
@endsection