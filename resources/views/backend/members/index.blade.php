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


    <div class="modal fade" id="locationModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Member</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <form id="" action="{{ route('team_member.add') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row row">
                            <div class="col-md-12">
                                <label for="">Name</label>
                                <input type="text" required name="name" value="" placeholder="Name"
                                    class="form-control ">
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="col-md-12">
                                <label for="">Designation</label>
                                <input type="text" required name="designation" value="" placeholder="Designation"
                                    class="form-control ">
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="col-md-12">
                                <label for="">Photo</label>
                                <input type="file" required name="photo" value="" placeholder="Designation"
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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
         
        
        <!-- Main content -->
        <section class="content">
            <button type="button" class="btn btn-primary mb-2 mt-2" data-toggle="modal" data-target="#locationModal">
                Add New
            </button>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="m-0 text-dark">Team Members</h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sno = 0; @endphp
                                    @foreach ($members as $row)
                                        @php $sno++ @endphp
                                        <tr>
                                            <td>{{ $sno }}</td>
                                            <td><img width="100" src="{{ asset('uploads/members').'/'.$row->photo }}" alt=""></td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->designation }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#Modal{{ $row->id }}"><span
                                                        class="fa fa-edit"></span></button>

                                                <a onclick="return confirm('are you sure?')"
                                                    href="{{ route('team_member.delete', $row->id) }}"
                                                    class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>

                                            </td>
                                        </tr>

                                        <div class="modal fade" id="Modal{{ $row->id }}">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Team Member</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                    
                                                    </div>
                                    
                                                    <form id="" action="{{ route('team_member.update') }}" enctype="multipart/form-data" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-row row">
                                                                <div class="col-md-12">
                                                                    <label for="">Name</label>
                                                                    <input type="text" required name="name" value="{{ $row->name }}" placeholder="Name"
                                                                        class="form-control ">
                                                                </div>
                                                            </div>
                                                            <div class="form-row row">
                                                                <div class="col-md-12">
                                                                    <label for="">Designation</label>
                                                                    <input type="text" required name="designation" value="{{ $row->designation }}" placeholder="Designation"
                                                                        class="form-control ">
                                                                </div>
                                                            </div>
                                                            <div class="form-row row">
                                                                <div class="col-md-12">
                                                                    <label for="">Photo</label>
                                                                    <input type="file" name="photo"  placeholder="Designation"
                                                                        class="form-control ">
                                                                    <img width="100" src="{{ asset('uploads/members').'/'.$row->photo }}" alt="">
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
