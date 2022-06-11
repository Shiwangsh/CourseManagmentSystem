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
                                <h5 class="nav-tabs-title">Update Assignment </h5>

                            </div>
                        </div>
                    </div>
                    <form action=" {{ route('assignments.update', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" value="{{$assignment->title}}" id="title" name="title" placeholder="Title ">
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <textarea name="info" class="form-control" cols="30" rows="8" placeholder="assignments details here">{{$assignment->info}}</textarea>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="date" class="form-control" value="{{$assignment->dealine}}" id="dealine" name="deadline" placeholder="Dealine ">
                                <p class="form-control"></p>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <select name="module_id" id="module_id" class="form-control">
                                    <option value="{{$assignment->module->id}}">{{$assignment->module->name}}</option>
                                    @foreach($modules as $module)
                                    <option value="{{$module->id}}">{{$module->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group mx-sm-3 mb-2">
                                <input type="file" name="file" class="form-control custom-file-input" id="validatedCustomFile" value="{{$assignment->file}}">
                                <label class="custom-file-label" for="validatedCustomFile">{{Str::limit($assignment->file,10)}}</label>
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