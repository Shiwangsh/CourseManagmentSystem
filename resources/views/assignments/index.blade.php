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
                                <h5 class="nav-tabs-title">Assignment : </h5>
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
                                        Title
                                    </th>
                                    <th>
                                        Details
                                    </th>
                                    <th>
                                        Deadline
                                    </th>
                                    <th>
                                        File
                                    </th>
                                    <th>
                                        Action
                                    </th>

                                </thead>
                                <tbody>
                                    @forelse($assignments as $assignment)
                                    <tr>
                                        <td>
                                            {{$loop->index+1}}
                                        </td>
                                        <td>
                                            {{$assignment->title}}
                                        </td>
                                        <td>
                                            {!!Str::limit($assignment->info,50)!!}
                                        </td>
                                        <td>
                                            {{$assignment->deadline}}
                                        </td>
                                        <td>
                                            <a target="_blank" href="{{Storage::url($assignment->file)}}">View</a>
                                        </td>

                                        <td class="form-inline">
                                            @if(Auth::user()->roles !='student')
                                            <a href="{{ route('assignments.edit', $assignment->slug) }}">
                                                <li class="fa fa-pencil fa-2x">
                                                </li>
                                            </a>
                                            @endif
                                            &nbsp;
                                            &nbsp;
                                            <a href="{{route('assignments.show',$assignment->slug)}}">

                                                <li class="fa fa-eye fa-2x green">
                                                </li>

                                            </a>
                                            &nbsp;
                                            &nbsp;

                                            @if(Auth::user()->roles !='student')
                                            <form action="{{route('assignments.delete',$assignment->id)}}" method="post">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="fa fa-trash fa-2x red"></button>
                                            </form>
                                            @endif
                                        </td>

                                    </tr>
                                    @empty
                                    <p class=" text-center">No assignments here..</p>
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
                <h5 class="modal-title" id="exampleModalLabel">Add assignments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('assignments.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title ">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <textarea name="info" class="form-control" cols="30" rows="8" placeholder="Assignments details here..."></textarea>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="date" class="form-control" id="dealine" name="deadline" placeholder="Dealine ">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="module_id" id="module_id" class="form-control">
                            <option value="">Select</option>
                            @foreach($modules as $module)
                            <option value="{{$module->id}}">{{$module->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group mx-sm-3 mb-2">
                        <input type="file" name="file" class="form-control custom-file-input" id="validatedCustomFile" required>
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
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