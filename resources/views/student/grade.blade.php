@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="col-lg-8 col-md-12 mt-5 m-5">
        <div class="card">
            <div class="card-header card-header-primary">
                <h2 class="card-title">{{Auth::user()->fname}} Report</h2>
                <p class="card-category">Your Progress is listed below</p>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead class="text-warning">
                        <th>ID</th>
                        <th>Assignment</th>
                        <th>Scored Grade</th>
                        <th>Remarks</th>
                    </thead>
                    <tbody>
                        @foreach($grades as $grade)
                        <tr>
                            <td>1</td>
                            <td>{{$grade->assignment->title}}</td>
                            <td class="ml-3">{{$grade->scored_grade}}</td>
                            <td> @if($grade->scored_grade !='F')
                                <span class="badge badge-success">
                                    {{$grade->remarks}}
                                </span>
                                @else
                                <span class="badge badge-danger">
                                    {{$grade->remarks}}
                                </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
@endsection