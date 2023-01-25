@extends('layouts.app')

@section('content')

    <div class="container">
        @forelse($errors->all() as $error)
            <div class="alert alert-warning alert-danger fade show" role="alert">
               <strong> {{$error}}</strong>
            </div>
        @empty
        @endforelse
        <div class="row justify-content-center">
            <div class="table-responsive">
                <div class="row  col-12 p-3">

                    <div  class="col-3 ">
                        <button type="button" data-toggle="modal" data-target="#addContract" class="btn btn-success" onclick="$('#addRoom').modal('toggle')">
                            Add Contract
                        </button>
                        <a type="button"
                           href="{{request('join') ? route('contracts.index',$room):route('contracts.join',[$room,'join']) }}"
                                class="btn btn-warning" >
                            {{request('join') ? 'Split It' : ' join It'}}
                        </a>

                    </div>
                    <div class="col-9 text-center">
                        <h4>
                            You Add Contract To Room N-{{$room->number}}
                        </h4>
                    </div>
                </div>

              @if(request('join'))

                    <table class="table">
                        <caption>List of Rooms</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">Creation Date</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($contracts as $key => $contract)

                            <tr>
                                <th scope="row">
                                    {{$contract[0]->id}}
                                </th>
                                <td>{{$contract[0]->name}}</td>
                                <td>{{$contract[0]->price}}</td>
                                <td>{{$contract[0]->start_date}}</td>
                                <td>{{$contract[0]->end_date}}</td>
                                <td>{{$contract[0]->created_at->diffForHumans()}}</td>
                                <td>
                                    <ul class="list-inline">
                                        <li class="list-inline-item" onclick="alert('It works but and his code is exists but i skipped it (see github)')" >
                                            <button class="btn btn-warning">
                                                Edit
                                            </button>
                                        </li>

                                        <li class="list-inline-item" >
                                            <form action="{{route('contracts.destroy',$contract[0])}}" method="post">
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
                                <th colspan="7" scope="row">
                                    <h3 class="text-muted text-center p-2">
                                        There's No Data To Show Please Create Contract
                                    </h3>
                                </th>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                @else
                    <table class="table">
                        <caption>List of Rooms</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">Creation Date</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($contracts as $contract)

                            <tr>
                                <th scope="row">
                                    {{$contract->id}}
                                </th>
                                <td>{{$contract->name}}</td>
                                <td>{{$contract->price}}</td>
                                <td>{{$contract->start_date}}</td>
                                <td>{{$contract->end_date}}</td>
                                <td>{{$contract->created_at->diffForHumans()}}</td>
                                <td>
                                    <ul class="list-inline">
                                        <li class="list-inline-item" onclick="alert('It works but and his code is exists but i skipped it (see github)')" >
                                            <button class="btn btn-warning">
                                                Edit
                                            </button>
                                        </li>

                                        <li class="list-inline-item" >
                                            <form action="{{route('contracts.destroy',$contract)}}" method="post">
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
                                <th colspan="7" scope="row">
                                    <h3 class="text-muted text-center p-2">
                                        There's No Data To Show Please Create Contract
                                    </h3>
                                </th>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <div class="modal fade" id="addRoom" tabindex="-1" role="dialog" aria-labelledby="addContract" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoom">Create A Contract For This Room</h5>
                    </div>
                    <div class="modal-body">
                        <form id="addNewRoom" action="{{route('contracts.store',$room)}}" method="post" >
                            @method('POST')
                            @csrf
                            <fieldset>
                                <legend>Basic Data</legend>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"
                                               name="name"
                                               id="name"
                                               value="{{old('name')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control"
                                               name="price"
                                               id="price"
                                               value="{{old('price')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">From</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control"
                                               name="start_date"
                                               id="start_date"
                                               value="{{old('start_date')}}">
                                    </div>
                                    <label for="staticEmail" class="col-sm-3 col-form-label">To</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control"
                                               name="end_date"
                                               id="end_date"
                                               value="{{old('end_date')}}">
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
