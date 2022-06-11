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
                                <h5 class="nav-tabs-title">Attendance : </h5>
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
                                       Date 
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                  
                                    <th>
                                        Action
                                    </th>

                                </thead>
                                <tbody>
                                    @forelse($attendances as $attendance)
                                    <tr>
                                        <td>
                                            {{$loop->index+1}}
                                        </td>
                                        <td>
                                            {{$attendance->user->fname}}
                                        </td>
                                        <td>
                                            {{$attendance->date}}
                                        </td>
                                       
                                        <td>
                                            @if($attendance->status =='0')
                                            <span class="badge badge-danger">
                                               Absent
                                            </span>
                                            @elseif($attendance->status =='1')
                                            <span class="badge badge-success">
                                               Present
                                            </span>
                                            @endif
                                        </td>
                                       

                                        <td class="form-inline">
                                            @if(Auth::user()->roles !='student')
                                            <a href="{{ route('attendances.edit', $attendance->id) }}">
                                                <li class="fa fa-pencil fa-2x">
                                                </li>
                                            </a>
                                            @endif
                                            &nbsp;
                                            &nbsp;
                                          

                                            @if(Auth::user()->roles !='student')
                                            <form action="{{route('attendances.delete',$attendance->id)}}" method="post">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="fa fa-trash fa-2x red"></button>
                                            </form>
                                            @endif
                                        </td>

                                    </tr>
                                    @empty
                                    <p class=" text-center">No attendances here..</p>
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
                <h5 class="modal-title" id="exampleModalLabel">Add attendances</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('attendances.store')}}" method="post" enctype="multipart/form-data">
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
                        <select name="status" id="status" class="form-control">
                            <option value="">--Status--</option>
                            <option value="0">Absent</option>
                            <option value="1">Present</option>
                           
                        </select>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                      <input type="date" class="form-control " name="date">
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