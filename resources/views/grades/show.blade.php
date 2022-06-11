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
                                <h2 class="nav-tabs-title"> {{$grade->title}} </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h6>{!!$grade->info!!}</h6>

                    <p class="green">Announced Date : <b>{{$grade->announce_date}}</b></p>
                </div>

            </div>
        </div>

    </div>

</div>
</div>


@endsection