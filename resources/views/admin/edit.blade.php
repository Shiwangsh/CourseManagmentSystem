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
                                <h5 class="nav-tabs-title">Update User </h5>

                            </div>
                        </div>
                    </div>
                    <form action=" {{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="name" class="sr-only">First Name</label>
                                <input type="text" class="form-control" value="{{$user->fname}}" id="name" name="fname" placeholder="user Name">
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="name" class="sr-only">Last Name</label>
                                <input type="text" class="form-control" value="{{$user->lname}}" id="name" name="lname" placeholder="user Name">
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <textarea name="address" class="form-control" cols="30" rows="8" placeholder="Address details here ..">{{$user->address}}</textarea>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <select name="roles" id="roles" class="form-control">
                                  <option value="tutor" {{ $user->roles == 'tutor' ? 'selected' : '' }}>Tutor</option>
                                  <option value="student" {{ $user->roles == 'student' ? 'selected' : '' }}>Student</option>
                                  <option value="admin" {{ $user->roles == 'admin' ? 'selected' : '' }}>Admin</option>
                                  
                                </select>
                            </div>
                        </div>
                        <div class=" modal-footer">
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