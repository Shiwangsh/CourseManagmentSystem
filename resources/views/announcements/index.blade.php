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
                                <h5 class="nav-tabs-title">Announcement : </h5>
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
                                        Announce Date
                                    </th>
                                    <th>
                                        Action
                                    </th>

                                </thead>
                                <tbody>
                                    @forelse($announcements as $announcement)
                                    <tr>
                                        <td>
                                            {{$loop->index+1}}
                                        </td>
                                        <td>
                                            {{$announcement->title}}
                                        </td>
                                        <td>
                                            {!!Str::limit($announcement->info,50)!!}
                                        </td>
                                        <td>
                                            {{$announcement->announce_date}}
                                        </td>

                                        <td class="form-inline">
                                            @if(Auth::user()->roles !='student')
                                            <a href="{{ route('announcements.edit', $announcement->slug) }}">
                                                <li class="fa fa-pencil fa-2x">
                                                </li>
                                            </a>
                                            @endif
                                            &nbsp;
                                            &nbsp;
                                            <a href="{{route('announcements.show',$announcement->slug)}}">

                                                <li class="fa fa-eye fa-2x green">
                                                </li>

                                            </a>
                                            &nbsp;
                                            &nbsp;

                                            @if(Auth::user()->roles !='student')
                                            <form action="{{route('announcements.delete',$announcement->id)}}" method="post">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="fa fa-trash fa-2x red"></button>
                                            </form>
                                            @endif
                                        </td>

                                    </tr>
                                    @empty
                                    <p class=" text-center">No announcements here..</p>
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
                <h5 class="modal-title" id="exampleModalLabel">Add announcements</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('announcements.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="title" class="sr-only">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title.. ">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="name" class="sr-only">Announcement Detail</label>
                        <textarea name="info" id="summary-ckeditor" class="form-control" cols="30" rows="8" placeholder="Announcements details here"></textarea>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="announce_date" class="sr-only">Announce Date</label>
                        <input type="date" class="form-control" id="announce_date" name="announce_date" placeholder="Announce Date ">
                    </div>
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}" placeholder="Announce Date ">

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