@extends('layout.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Board view</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('boards.all')}}">Boards</a></li>
                        <li class="breadcrumb-item active">Tasks</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">

{{--                <h3 class="card-title">{{$board->name}}</h3>--}}
            </div>

                <div class="card-body">
                    <select class="custom-select rounded-0" id="changeBoard">
                        @foreach($boards as $selectBoard)
                            <option @if ($selectBoard->id === $board->id) selected="selected" @endif value="{{$selectBoard->id}}">{{$selectBoard->name}}</option>
                        @endforeach
                    </select>
                </div>

                <table class="table table-bordered">
                     <thead>
                        <tr>
                            <th style="width: 10px">id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>assignment</th>
                            <th>status</th>
                            <th>date of creation</th>
                            <th style="width: 40px">Actions</th>
                        </tr>

                     </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{$task->id}}</td>
                            <td>{{$task->name}}</td>
                            <td>{{$task->description}}</td>
                            <td>{{$task->assignment}}</td>
                            <td>{{$task->status}}</td>
                            <td>{{$task->created_at}}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-primary"
                                            type="button"
                                            data-task="{{json_encode($tasks)}}"
                                            data-toggle="modal"
                                            data-target="#taskEditModal">
                                        <i class="fas fa-edit"></i></button>
                                    <button class="btn btn-xs btn-danger"
                                            type="button"
                                            data-task="{{json_encode($tasks)}}"
                                            data-toggle="modal"
                                            data-target="#taskDeleteModal">
                                        <i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
        <!-- /.card -->

        <div class="modal fade" id="boardEditModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit task</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="taskEditButton">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="taskDeleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete task</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger hidden" id="taskDeleteAlert"></div>
                        <input type="hidden" id="taskDeleteId" value="" />
                        <p>Are you sure you want to delete: <span id="taskDeleteName"></span>?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="taskDeleteButton">Delete</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </section>
    <!-- /.content -->
@endsection
