@extends('layouts.app')

@section('content')

<div class="content mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header card-header-tabs card-header-primary">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <h5 class="nav-tabs-title">Update Module </h5>

                            </div>
                        </div>
                    </div>
                    <form action=" {{ route('modules.update', $module->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" value="{{$module->name}}" id="name" name="name" placeholder="Module Name">
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <textarea name="info" id="summary-ckeditor" class="form-control" cols="30" rows="8" placeholder="Modules details here">{{$module->info}}</textarea>
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