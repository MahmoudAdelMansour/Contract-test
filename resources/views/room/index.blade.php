@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="table-responsive">
            <div class="row  col-12">
                <div >
                    <button type="button" data-toggle="modal" data-target="#addRoom" class="btn btn-success" onclick="$('#addRoom').modal('toggle')">
                        Add Room
                    </button>
                </div>

            </div>
            <table class="table">
                <caption>List of Rooms</caption>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Creation Date</th>
                    <th scope="col">Contracts Count</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($rooms as $room)
                    <tr>
                        <th scope="row">
                            {{$room->number}}
                        </th>
                        <td>{{$room->name}}</td>
                        <td>{{$room->type}}</td>
                        <td>{{$room->created_at->diffForHumans()}}</td>
                        <td>{{$room->contracts->count()}}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item" onclick="alert('It works but and his code is exists but i skipped it (see github)')" >
                                    <button class="btn btn-warning">
                                        Edit
                                    </button>
                                </li>
                                <li class="list-inline-item" >
                                    <a class="btn btn-info" href="{{route('contracts.index',$room)}}">
                                        Contracts
                                    </a>
                                </li>
                                <li class="list-inline-item" >
                                    <form action="{{route('rooms.destroy',$room)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>

                                </li>
                            </ul>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="6" scope="row">
                            <h3 class="text-muted text-center p-2">
                                There's No Data To Show Please Create Room
                            </h3>
                        </th>
                    </tr>
                @endforelse


                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="addRoom" tabindex="-1" role="dialog" aria-labelledby="addRoom" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoom">Create A Room</h5>
                </div>
                <div class="modal-body">
                    <form id="addNewRoom" action="{{route('rooms.store')}}" method="post" >
                        @method('POST')
                        @csrf
                        <fieldset>
                            <legend>Basic Data</legend>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Room Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                           name="name"
                                           id="name"
                                           value="{{old('name')}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Room Number</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                           name="number"
                                           id="name"
                                           value="{{old('number')}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Room Type</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                           name="type"
                                           id="type"
                                           value="{{old('type')}}">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="addNewRoom" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
