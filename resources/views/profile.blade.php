 @extends('layouts.app')

 @section('content')

 <div class="container-fluid mt-5 text-center">
     <div class="row">
         <div class="col-md-8">
             <div class="card">
                 <div class="card-header card-header-primary">
                     <h4 class="card-title">Edit Profile</h4>
                     <p class="card-category">Complete your profile</p>
                 </div>
                 <div class="card-body">
                     <form action="{{route('user.update')}}" method="POST">
                         @csrf
                         <div class="form-group ">
                             <label for="name" class="col-md-4 col-form-label text-sm-left">{{ __('First Name') }}</label>

                             <div class="col-sm-6 offset-md-4">
                                 <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{Auth::user()->fname}}" autocomplete="fname" autofocus>

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
                                 <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{Auth::user()->lname}}" autocomplete="lname" autofocus>

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
                                 <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{Auth::user()->dob}}" autocomplete="dob" autofocus>

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
                                 <input id="contact" type="tel" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{Auth::user()->contact}}" autocomplete="contact" autofocus>

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

                                 <textarea name="address" class="form-control" id="" cols="10" rows="3">
                                 {{Auth::user()->address}}
                                 </textarea>
                                 @error('address')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                             </div>
                         </div>

                         <div class="form-group row">
                             <label for="name" class="col-md-4 col-form-label text-sm-left">{{ __('Gender') }}</label>

                             <div class="col-md-2 ">
                                 <input id="gender" type="radio" name="gender" value="{{ Auth::user()->gender }}" {{  (Auth::user()->gender == 'male' ? ' checked' : '') }}> Male &nbsp;
                                 <br>
                                 &nbsp;

                                 <input id="gender" type="radio" name="gender" value="{{ Auth::user()->gender }}" {{  (Auth::user()->gender == 'female' ? ' checked' : '') }}> Female &nbsp;
                                 <br>
                                 &nbsp;
                                 <input id="gender" type="radio" name="gender" value="others" autocomplete="gender"> Others &nbsp;


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
                                 <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth::user()->email }}">

                                 @error('email')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                             </div>
                         </div>

                         <div class="form-group row">
                             <label for="password" class="col-md-4 col-form-label text-sm-left">{{ __('Old Password') }}</label>

                             <div class="col-md-6 offset-md-4">
                                 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="current_password" autocomplete="current-password">

                                 @error('current_password')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                             </div>
                         </div>

                         <div class="form-group row">
                             <label for="password" class="col-md-4 col-form-label text-sm-left">{{ __('New Password') }}</label>

                             <div class="col-md-6 offset-md-4">
                                 <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                             </div>
                             @error('new_password')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                             @enderror
                         </div>

                         <div class="form-group row">
                             <label for="password" class="col-md-4 col-form-label text-sm-left">{{ __('New Confirm Password') }}</label>

                             <div class="col-md-6 offset-md-4">
                                 <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                             </div>
                             @error('new_confirm_password')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                             @enderror
                         </div>

                         <div class="form-group row mb-0">
                             <div class="col-md-6 offset-md-4 offset-md-4">
                                 <button type="submit" class="btn btn-primary">
                                     {{ __('Update') }}
                                 </button>
                             </div>
                         </div>

                     </form>

                 </div>
             </div>
         </div>
         <div class="col-md-4">
             <div class="card card-profile">
                 <div class="card-avatar">
                     <a href="javascript:;">
                         <img class="img" src="../assets/img/faces/marc.jpg" />
                     </a>
                 </div>
                 <div class="card-body">
                     <h6 class="card-category text-gray">{{Auth::user()->roles}}</h6>
                     <h4 class="card-title">{{Auth::user()->fname}} {{Auth::user()->lname}}</h4>
                     <p class="card-description">
                     <p>Date of Birth : {{Auth::user()->dob}}</p>
                     <p>Contact Details : {{Auth::user()->contact}}</p>
                     <p>Email Address : {{Auth::user()->email}}</p>
                     </p>
                     <a href="javascript:;" class="btn btn-primary btn-round">Update Profile</a>
                 </div>
             </div>
         </div>
     </div>
 </div>
 @endsection