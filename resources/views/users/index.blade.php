@extends('layout.main')

@section('content')
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Display Users </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Is Verified</th>
                            <th style="width: 100px">Role</th>
                            <th style="width: 40px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->email_verified_at)
                                        <span class="badge bg-primary">Verified</span>
                                    @else
                                        <span class="badge bg-warning">Unverified</span>
                                    @endif
                                </td>
                                <td>{{$user->role === \App\Models\User::ROLE_ADMIN ? 'Admin' : 'User'}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-primary" type="button" data-user="{{json_encode($user)}}" data-toggle="modal" data-target="#edit-modal">
                                            <i class="fas fa-edit"></i></button>
                                        <button class="btn btn-xs btn-danger" type="button" data-user="{{json_encode($user)}}" data-toggle="modal" data-target="#delete-modal">
                                            <i class="fas fa-trash"></i></button>


{{--                                        <div id="confirmModal" class="modal fade" role="dialog">--}}
{{--                                            <div class="modal-dialog">--}}
{{--                                                <div class="modal-content">--}}
{{--                                                    <div class="modal-header">--}}
{{--                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
{{--                                                        <h2 class="modal-title">Confirmation</h2>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="modal-body">--}}
{{--                                                        <h4 align="center" style="margin:0;">Are you sure you want to remove this job?</h4>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="modal-footer">--}}
{{--                                                        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>--}}
{{--                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}


                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    @if ($users->currentPage() > 1)
                        <li class="page-item"><a class="page-link" href="{{$users->previousPageUrl()}}">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="{{$users->url(1)}}">1</a></li>
                    @endif

                    @if ($users->currentPage() < $users->lastPage() )
                        <li class="page-item"><a class="page-link" href="{{$users->url($users->lastPage())}}">{{$users->lastPage()}}</a></li>
                        <li class="page-item"><a class="page-link" href="{{$users->nextPageUrl()}}">&raquo;</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- /.card -->

        <div class="modal fade" id="edit-modal">
            <div class="modal-dialog">
                <form action="" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit user</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="editName"></div>
                            <input type="hidden" name="editId" value="" />
                            <div class="form-group">
                                <label for="editRole">Role</label>
                                <select class="custom-select rounded-0" id="editRole">
                                    <option value="{{\App\Models\User::ROLE_USER}}">User</option>
                                    <option value="{{\App\Models\User::ROLE_ADMIN}}">Admin</option>
                                </select>
                                <div class="modal-body">
                                    <h4 align="center" style="margin:0;">Edit User fields: </h4>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputText">User Name</label>
                                    <input type="text" class="form-control" id="exampleInputText"  placeholder="Enter Your Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        //Delete button
        <div class="modal fade" id="delete-modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title">Confirmation</h2>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin:0;">Are you sure you want to remove this job?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->



    //Ajax pentru buttonul de delete cu redirect pe alta pagina
<script>

    $(document).on('click', '.delete', function(){
        const id = $(this).attr('id');
        $('#delete-modal').modal('show');
    });

    $('#ok_button').click(function(){
        $.ajax({
            url:"/user/destroy/"+id,
            beforeSend:function(){
                $('#ok_button').text('Deleting...');
            },

            success:function(data)
            {
                setTimeout(function(){
                    $('#delete-modal').modal('hide');
                    $('#jobsTable').DataTable().ajax.reload();
                }, 2000);
            }
        })
    });

</script>



  //ruta noua pentru edit

        <script type="text/javascript">

            $.ajaxSetup({

            headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

        });

            $("btn btn-xs btn-primary").click(function(e){

            e.preventDefault();

                const name = $("input[name=name]").val();

                const password = $("input[name=password]").val();

                const email = $("input[name=email]").val();

                $.ajax({

            type:'POST',

            url:'/ajaxRequest',

            data:{name:name, password:password, email:email},

            success:function(data){

            alert(data.success);
        }
        });
        });

    </script>


@endsection
