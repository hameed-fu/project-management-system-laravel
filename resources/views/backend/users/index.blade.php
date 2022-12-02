@extends('backend.layouts.app')
@section('content')
    <!-- Navbar -->
    @include('backend.layouts.topbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->

        <!-- Sidebar -->
        <div class="sidebar">

            @include('backend.layouts.sidebar')
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="modal fade" id="userModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>

                    <form id="userForm" action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-row row">
                                <div class="col-md-12">
                                    <label for="">Name</label>
                                    <input type="text" required name="name" value="" placeholder="Name"
                                        class="form-control ">
                                </div>
                                <div class="col-md-12">
                                    <label for="">Email</label>
                                    <input type="email" required name="email" value="" placeholder="Email"
                                        class="form-control ">
                                </div>
                            </div>

                            <div class="form-row row">
                                <div class="col-md-12">

                                  <label for="">Password</label>
                                  <input type="text" required name="password" value="" placeholder="Password"
                                      class="form-control ">
                                </div>
                                
                            </div>

                             

 

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- Main content -->
        <section class="content">
            <button type="button" class="btn btn-primary mb-2 mt-2" data-toggle="modal" data-target="#userModal">
                Add New
            </button>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="m-0 text-dark">Users</h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sno = 0; @endphp
                                    @foreach ($users as $row)
                                        @php $sno++ @endphp
                                        <tr>
                                            <td>{{ $sno }}</td>

                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->role }}</td>
                                            <td>


                                                <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#userModal{{ $row->id }}"><span
                                                        class="fa fa-edit"></span></a>

                                                <a onclick="return confirm('are you sure?')"
                                                    href="{{ route('user.delete', $row->id) }}"
                                                    class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
                                                
                                                </div>

                                            </td>
                                        </tr>

                                        <div class="modal fade" id="userModal{{ $row->id }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update User</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                
                                                    </div>
                                
                                                    <form id="userForm" action="{{ route('user.update') }}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-row row">
                                                                <div class="col-md-6">
                                                                    <label for="">Name</label>
                                                                    <input type="text" required name="name" value="{{ $row->name }}" placeholder="Name"
                                                                        class="form-control ">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="">Email</label>
                                                                    <input type="email" required name="email" value="{{ $row->email }}" placeholder="Email"
                                                                        class="form-control ">
                                                                </div>
                                                            </div>
                                
                                                            
                                 
                                                          <input type="hidden" name="id" value="{{ $row->id }}">
                                
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
   
@endsection
