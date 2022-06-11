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
                                <h5 class="nav-tabs-title">User Management : </h5>
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
                                        First Name
                                    </th>
                                    <th>Last Name</th>
                                    <th>Address</th>
                                    <th>Contact Us</th>
                                    <th>Gender</th>
                                    <th>
                                        Role
                                    </th>
                                    <th>
                                        Action
                                    </th>

                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                    <tr>
                                        <td>
                                            {{$loop->index+1}}
                                        </td>
                                        <td>
                                            {{$user->fname}}
                                        </td>
                                        <td>
                                            {{$user->lname}}
                                        </td>
                                        <td>
                                            {{$user->address}}
                                        </td>
                                        <td>
                                            {{$user->contact}}
                                        </td>
                                        <td>
                                            {{$user->gender}}
                                        </td>
                                        <td>
                                            <span class="badge badge-success">{{ $user->roles}}</span>
                                        </td>
                                        <td class="form-inline">
                                            @if(Auth::user()->roles !='student')

                                            <a href="{{ route('users.edit', $user->id) }}">
                                                <li class="fa fa-pencil fa-2x">
                                                </li>
                                            </a>
                                            @endif

                                            @if(Auth::user()->roles !='student')

                                            <form action="{{route('users.delete',$user->id)}}" method="post">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="fa fa-trash fa-2x red"></button>
                                            </form>
                                            @endif
                                        </td>

                                    </tr>
                                    @empty
                                    <p class=" text-center">No users here..</p>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="m-2 p-2">
                                {{ $users->links() }}

                            </div>
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
                <h5 class="modal-title" id="exampleModalLabel">Add users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('users.store')}}">
                @csrf

                <div class="form-group ">
                    <label for="name" class="col-md-4 col-form-label text-sm-left">{{ __('First Name') }}</label>

                    <div class="col-sm-6 offset-md-4">
                        <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" autocomplete="fname" autofocus>

                        @error('fname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-sm-left">{{ __('Last Name') }}</label>

                    <div class="col-sm-6 offset-md-4">
                        <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" autocomplete="lname" autofocus>

                        @error('lname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dob" class="col-md-4 col-form-label text-sm-left">{{ __('Date of Birth') }}</label>

                    <div class="col-md-6 offset-md-4">
                        <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" autocomplete="dob" autofocus>

                        @error('dob')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-sm-left">{{ __('Contact Info') }}</label>

                    <div class="col-md-6 offset-md-4">
                        <input id="contact" type="tel" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" autocomplete="contact" autofocus>

                        @error('contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-sm-left">{{ __('Address ') }}</label>

                    <div class="col-md-6 offset-md-4">

                        <textarea name="address" class="form-control" id="" cols="10" rows="3"></textarea>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="roles" class="col-md-4 col-form-label text-sm-left">{{ __('Assign Role ') }}</label>

                    <div class="col-md-6 offset-md-4">
                        <select class="form-control" name="roles">
                            <option value="">--Select Role---</option>
                            <option value="admin">Admin</option>
                            <option value="tutor">Tutor</option>
                            <option value="student">Student</option>
                        </select>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-sm-left">{{ __('Gender') }}</label>

                    <div class="col-md-2">
                        <input id="gender" type="radio" name="gender" value="male" autocomplete="gender" autofocus> Male &nbsp;
                        <br>
                        <input id="gender" type="radio" name="gender" value="female" autocomplete="gender" autofocus> Female &nbsp;
                        <input id="gender" type="radio" name="gender" value="others" autocomplete="gender" autofocus> Others &nbsp;

                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-sm-left">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6 offset-md-4">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-sm-left">{{ __('Password') }}</label>

                    <div class="col-md-6 offset-md-4">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-sm-left">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6 offset-md-4">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection