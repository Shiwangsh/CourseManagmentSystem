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
                                <h5 class="nav-tabs-title">Grade : </h5>
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
                                        Student Name
                                    </th>
                                    <th>
                                        Assignment Name
                                    </th>
                                    <th>
                                        Scored Grade
                                    </th>
                                    <th>
                                        Remarks
                                    </th>
                                    <th>
                                        File
                                    </th>
                                    <th>
                                        Action
                                    </th>

                                </thead>
                                <tbody>
                                    @forelse($grades as $grade)
                                    <tr>
                                        <td>
                                            {{$loop->index+1}}
                                        </td>
                                        <td>
                                            {{$grade->user->fname}}
                                        </td>
                                        <td>
                                            {{$grade->assignment->title}}
                                        </td>
                                        <td>
                                            {{$grade->scored_grade}}
                                        </td>
                                        <td>
                                            @if($grade->scored_grade !='F')
                                            <span class="badge badge-success">
                                                {{$grade->remarks}}
                                            </span>
                                            @else
                                            <span class="badge badge-danger">
                                                {{$grade->remarks}}
                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a target="_blank" href="{{Storage::url($grade->file)}}">View</a>
                                        </td>

                                        <td class="form-inline">
                                            @if(Auth::user()->roles !='student')
                                            <a href="{{ route('grades.edit', $grade->id) }}">
                                                <li class="fa fa-pencil fa-2x">
                                                </li>
                                            </a>
                                            @endif
                                            &nbsp;
                                            &nbsp;
                                            <a href="{{route('grades.show',$grade->id)}}">

                                                <li class="fa fa-eye fa-2x green">
                                                </li>

                                            </a>
                                            &nbsp;
                                            &nbsp;

                                            @if(Auth::user()->roles !='student')
                                            <form action="{{route('grades.delete',$grade->id)}}" method="post">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="fa fa-trash fa-2x red"></button>
                                            </form>
                                            @endif
                                        </td>

                                    </tr>
                                    @empty
                                    <p class=" text-center">No grades here..</p>
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
                <h5 class="modal-title" id="exampleModalLabel">Add grades</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('grades.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="form-group mx-sm-3 mb-2">
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="">--Select Student--</option>

                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="assignment_id" id="assignment_id" class="form-control">
                            <option value="">--Select Assignment--</option>
                            @foreach($assignments as $assignment)
                            <option value="{{$assignment->id}}">{{$assignment->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="scored_grade" id="scored_grade" class="form-control">
                            <option value="">--Select Scored Grade--</option>
                            <option value="A">A</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B">B</option>
                            <option value="B-">B-</option>
                            <option value="C+">C+</option>
                            <option value="C">C</option>
                            <option value="C-">C-</option>
                            <option value="D+">D+</option>
                            <option value="D">D</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    <div class="form-group mx-sm-3 mb-5">
                        <input type="file" name="file" class="form-control custom-file-input" id="validatedCustomFile" required>
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <textarea name="remarks" class="form-control" cols="20" rows="3" placeholder="Add remarks"></textarea>
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