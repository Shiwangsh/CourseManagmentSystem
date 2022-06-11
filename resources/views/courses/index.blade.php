@extends('layouts.app')

@section('content')
<div class="content mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header card-header-tabs card-header-primary">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <h5 class="nav-tabs-title">Course Management : </h5>
                                @if(Auth::user()->roles !='student')
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="modal" data-target="#exampleModal">
                                            <i class="material-icons">add</i> Add
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>

                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Details
                                    </th>
                                    <th>
                                        Action
                                    </th>

                                </thead>
                                <tbody>
                                    @forelse($courses as $course)
                                    <tr>
                                        <td>
                                            {{$loop->index+1}}
                                        </td>
                                        <td>
                                            {{$course->name}}
                                        </td>
                                        <td>
                                            {{Str::limit($course->info,50)}}
                                        </td>
                                        <td class="form-inline">
                                            @if(Auth::user()->roles !='student')

                                            <a href="{{ route('courses.edit', $course->slug) }}">
                                                <li class="fa fa-pencil fa-2x">
                                                </li>
                                            </a>
                                            @endif
                                            &nbsp;
                                            &nbsp;
                                            <a href="{{route('courses.show',$course->slug)}}">

                                                <li class="fa fa-eye fa-2x green">
                                                </li>

                                            </a>
                                            &nbsp;
                                            &nbsp;

                                            @if(Auth::user()->roles !='student')

                                            <form action="{{route('courses.delete',$course->id)}}" method="post">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="fa fa-trash fa-2x red"></button>
                                            </form>
                                            @endif
                                        </td>

                                    </tr>
                                    @empty
                                    <p class=" text-center">No Courses here..</p>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Courses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('courses.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Course Name">
                        @if(Auth::user()->roles =='admin')
                        <select name="user_id" id="user_id" class="form-control">
                            @forelse($users as $user)
                            <option value="{{$user->id}}">{{$user->fname}}</option>
                            @empty
                            @endforelse
                        </select>

                        @endif
                        @if(Auth::user()->roles =='tutor')

                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                        @endif

                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <textarea name="info" class="form-control" cols="30" rows="4" placeholder="Courses details here"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection