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
                                <h2 class="nav-tabs-title"> {{$assignment->title}} </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h6>{{$assignment->info}}</h6>
                    <p class="green">Deadline : {{$assignment->deadline}}</p>
                    <iframe src="{{Storage::url($assignment->file)}}" width="700px" height="500px"></iframe>

                </div>
            </div>
            @if(Auth::user()->roles =='student')
            <div class="col-md-4 ">
                <div class="card">
                    <div class="table-responsive">

                        <table class="table">
                            <thead class=" text-primary">
                                <th>SN</th>
                                <th>Date</th>
                                <th>Assignment</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @forelse($submits as $submit)
                                <tr>
                                    <td>
                                        {{$loop->index+1}}
                                    </td>
                                    <td>{{$submit->created_at->format('d/m/Y')}}</td>
                                    <td class="text-center">
                                        <a target="_blank" href="{{Storage::url($submit->file)}}"><b>View</b></a>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger">Pending</span>
                                    </td>
                                </tr>
                                @empty
                                <marquee class="text-center red">You haven't Submited any assignment yet</marquee>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>


                <form action="{{route('assignmentsstudent.store')}}" method="post" enctype="multipart/form-data" class="form-inline">
                    @csrf
                    <label for="" class="red">Submit Assignment</label>
                    <input type="file" name="file" id="" required>
                    <input type="hidden" name="assignment_id" value="{{$assignment->id}}">
                    <input type="hidden" name="module_id" value="{{$assignment->module->id}}">
                    <button class="btn btn-warning">Upload</button>
                </form>

            </div>
            @endif


        </div>

    </div>
</div>


@endsection