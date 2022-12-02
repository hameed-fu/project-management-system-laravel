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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Project</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <form id="" action="{{ route('project.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row row">
                            <div class="col-md-6">
                                <label for="">Project Name</label>
                                <input type="text" required name="name" placeholder="Name" class="form-control ">
                            </div>
                            <div class="col-md-6">
                                <label for="">Owner</label>
                                <input type="text" required name="owner_name" placeholder="Owner Name"
                                    class="form-control ">
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="col-md-6">
                                <label for="">Functional Requirements</label>
                                <textarea rows="5" required name="functional_requirements" placeholder="Functional Requirements"
                                    class="form-control "></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="">None Functional Requirements</label>
                                <textarea rows="5" required name="non_functional_requirements" placeholder="Non Functional Requirements"
                                    class="form-control "></textarea>
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="col-md-12">
                                <label for="">Description</label>
                                <textarea rows="5" required name="description" placeholder="Description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="col-md-12">
                                
                                <div class="form-group">
                                    <label for="">Team Member</label>
                                    <select class="select2" multiple="multiple" name="member_id[]" data-placeholder="Select Team Member" style="width: 100%;">
                                        @foreach ($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                                        @endforeach
                                    </select>
                                  </div>
                            </div>
                        </div>
                         
                        

                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <div class="table-responsive">
                                        
                                        <table class="table table-bordered" id="dynamic_field">
                                            <tr>
                                                <th>Risk</th>
                                                <th>+</th>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="risk[]" placeholder="Enter risk"
                                                        required class="form-control name_list" /></td>
                                                
                                                <td><button type="button" name="add" id="add"
                                                        class="btn btn-success btn-sm">+</button></td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
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
                            <h4 class="m-0 text-dark">Projects</h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Owner</th>
                                        <th>Team Members</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sno = 0; @endphp
                                    @foreach ($projects as $row)
                                        @php $sno++ @endphp
                                        <tr>
                                            <td>{{ $sno }}</td>

                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->owner_name }}</td>
                                            <td>
                                               @php
                                               $team_members = explode(",",$row->member_id);
                                            
                                               @endphp
                                                 <ul class="list-inline">
                                                   @foreach ($team_members as $k => $m)
                                                   @php
                                                   $t_member = App\Models\TeamMember::where('id',$m)->first();
                                                   @endphp
                                                        <li class="list-inline-item">
                                                            <img title="{{ $t_member->name }}" width="40" class="table-avatar img-circle" src="{{ asset('uploads/members').'/'.$t_member->photo }}">
                                                        </li>
                                                    
                                                   @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ $row->description }}</td>
                                            
                                            <td>
                                                <button  class="btn btn-sm btn-primary details" data-project="{{ $row->id }}" data-toggle="modal"
                                                    data-target="#ViewModal{{ $row->id }}"><span
                                                        class="fa fa-eye"></span></button>
                                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#Modal{{ $row->id }}"><span
                                                        class="fa fa-edit"></span></button>
                                                <a onclick="return confirm('are you sure?')"
                                                    href="{{ route('project.delete', $row->id) }}"
                                                    class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>

                                            </td>
                                        </tr>

                                       

                                        <div class="modal fade" id="ViewModal{{ $row->id }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Project Details</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>

                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-row row">
                                                            <div class="col-md-4"> 
                                                                <strong>Project Name</strong>
                                                            </div> 
                                                            <div class="col-md-8">
                                                                {{ $row->name }}
                                                            </div> 
                                                        </div>
                                                        <hr>
                                                        <div class="form-row row ">
                                                            <div class="col-md-4"> 
                                                                <strong>Owner</strong>
                                                            </div> 
                                                            <div class="col-md-8">
                                                                {{ $row->owner_name }}
                                                            </div> 
                                                        </div>
                                                        <hr>
                                                        <div class="form-row row ">
                                                            <div class="col-md-4"> 
                                                                <strong>Description</strong>
                                                            </div> 
                                                            <div class="col-md-8">
                                                                {{ $row->description }}
                                                            </div> 
                                                        </div>
                                                        <hr>
                                                        <div class="form-row row ">
                                                            <div class="col-md-4"> 
                                                                <strong>Functional Requirements</strong>
                                                            </div> 
                                                            <div class="col-md-8">
                                                                {{ $row->functional_requirements }}
                                                            </div> 
                                                        </div>
                                                        <hr>
                                                        <div class="form-row row ">
                                                            <div class="col-md-4"> 
                                                                <strong>Non Functional Requirements</strong>
                                                            </div> 
                                                            <div class="col-md-8">
                                                                {{ $row->non_functional_requirements }}
                                                            </div> 
                                                        </div><hr>
                                                        <div class="form-row row ">
                                                            <div class="col-md-4"> 
                                                                <strong>Members</strong>
                                                            </div> 
                                                            <div class="col-md-8">
                                                                @php
                                                                $team_members = explode(",",$row->member_id);
                                                                
                                                                @endphp
                                                                    <ul class="list-inline">
                                                                    @foreach ($team_members as $k => $m)
                                                                    @php
                                                                    $t_member = App\Models\TeamMember::where('id',$m)->first();
                                                                    @endphp
                                                                            <li class="list-inline-item">
                                                                                <img title="{{ $t_member->name }}" width="40" class="table-avatar img-circle" src="{{ asset('uploads/members').'/'.$t_member->photo }}">
                                                                            </li>
                                                                        
                                                                    @endforeach
                                                                    </ul>
                                                            </div> 
                                                        </div>
                                                        <hr>
                                                        <h3>Risks</h3>
                                                        @foreach ($row->risks as $risk)
                                                        <div class="row" id="">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body p-1">
                                                                        <strong>{{ $risk->name }}</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                        <div class="modal fade" id="Modal{{ $row->id }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Project</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>

                                                    </div>

                                                    <form id="" action="{{ route('project.update') }}"
                                                        enctype="multipart/form-data" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-row row">
                                                                <div class="col-md-6">
                                                                    <label for="">Project Name</label>
                                                                    <input type="text" required name="name" value="{{ $row->name }}" placeholder="Name" class="form-control ">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="">Owner</label>
                                                                    <input type="text" required value="{{ $row->owner_name }}" name="owner_name" placeholder="Owner Name"
                                                                        class="form-control ">
                                                                </div>
                                                            </div>
                                                            <div class="form-row row">
                                                                <div class="col-md-6">
                                                                    <label for="">Functional Requirements</label>
                                                                    <textarea rows="5" required name="functional_requirements" placeholder="Functional Requirements"
                                                                        class="form-control ">{{ $row->functional_requirements }}</textarea>
                                                                </div>
                                    
                                                                <div class="col-md-6">
                                                                    <label for="">None Functional Requirements</label>
                                                                    <textarea rows="5" required name="non_functional_requirements" placeholder="Non Functional Requirements"
                                                                        class="form-control ">{{ $row->non_functional_requirements }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-row row">
                                                                <div class="col-md-12">
                                                                    <label for="">Description</label>
                                                                    <textarea rows="5" required name="description" placeholder="Description" class="form-control">{{ $row->description }}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-row row">
                                                                <div class="col-md-12">
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="">Team Member</label>
                                                                        <select class="select2" multiple="multiple" name="member_id[]" data-placeholder="Select Team Member" style="width: 100%;">
                                                                            @foreach ($members as $member)
                                                                                <option {{$member->id == $row->member_id ? 'selected':''  }} value="{{ $member->id }}">{{ $member->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                      </div>
                                                                </div>
                                                            </div>
                                                                <input type="hidden" name="id"
                                                                    value="{{ $row->id }}">
                                                            

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
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
    <script>
        // $.noConflict();
        $(function() {
            var i = 1;
            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<tr id="row' + i +
                    '"><td><input type="text" required name="risk[]" placeholder="Enter risk" class="form-control name_list" /></td><td><button type="button" name="remove" id="' +
                    i + '" class="btn btn-danger btn-sm btn_remove"><span class="fa fa-trash"></span></button></td></tr>');
            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
            
        })

        
        
    </script>
@endsection
