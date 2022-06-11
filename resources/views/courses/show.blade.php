@extends('layouts.app')

@section('content')

<div class="content mt-5">
    <div class="container-fluid">
        <a href="{{ url()->previous() }}" type="button" class="btn btn-warning" data-dismiss="modal">
            <i class="material-icons">arrow_back</i> Back
        </a>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-primary">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <h2 class="nav-tabs-title"> {{$course->name}} </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h6>{{$course->info}}</h6>
                </div>
                <hr>
                <hr>
                <h3 class="text-center">Modules</h3>
                @if(Auth::user()->roles !='student')

                <a class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                    <i class="material-icons">add</i> Add
                    <div class="ripple-container"></div>
                </a>
                @endif
                <div id="accordion">
                    @forelse($modules as $module)
                    <div class="card">
                        <div class="card-header" id="heading{{ $loop->index }}">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{ $loop->index }}" aria-expanded="false" aria-controls="collapse{{ $loop->index }}">
                                    <b>{{$module->name}} </b>
                                    @if(Auth::user()->roles !='student')

                                    <div class="float-right">
                                        <form action="{{route('modules.delete',$module->id)}}" method="post">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button type="submit" class="float-right fa fa-trash red"></button>&nbsp;&nbsp;
                                        </form>
                                        <a href="{{ route('modules.edit', $module->slug) }}" class="float-right fa fa-pencil">&nbsp;&nbsp;</a>
                                    </div>
                                    @endif
                                </button>
                            </h5>
                        </div>
                        <div id="collapse{{ $loop->index }}" class="collapse" aria-labelledby="heading{{ $loop->index }}" data-parent="#accordion">
                            <div class="card-body">
                                {!!$module->info!!}
                                <br>
                                <p>Lecturer : <b class=" green">{{$module->user->fname}} {{$module->user->lname}}</b></p>

                            </div>
                        </div>
                    </div>
                    @empty
                    <br>
                    <h5 class="float-center">No modules found</h5>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="col-md-12">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Module</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('modules.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="name" class="sr-only">Module Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Module Name">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="name" class="sr-only">Module Detail</label>
                            <textarea name="info" class="form-control" id="summary-ckeditor" cols="30" rows="18" placeholder="Module details here..."></textarea>
                        </div>
                        @if(Auth::user()->roles=='admin')
                        <div class="form-group mx-sm-3 mb-2">
                            <select name="user_id" id="" class=" form-control">
                                <option value="">Select Tutor</option>
                                @forelse($users as $user)
                                <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                                @empty
                                <p>No tutor added</p>
                                @endforelse
                            </select>
                        </div>
                        @else
                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                        @endif
                        <input type="hidden" class="form-control" id="user_id" name="course_id" value="{{$course->id}}">
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

@endsection