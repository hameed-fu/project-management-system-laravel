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
                    <h4 class="modal-title">Add Hours</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <form id="" action="{{ route('project.add_hours') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row row">
                            <div class="col-md-12">
                                <label for="">Project</label>
                                <select name="project_id" required class="form-control" id="">
                                    <option value="">Please select</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="col-md-12">
                                <label for="">Analysis</label>
                                <input type="text" required name="analysis" value="0" class="form-control ">
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="col-md-12">
                                <label for="">Designing</label>
                                <input type="text" required name="designing" value="0" class="form-control ">
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="col-md-12">
                                <label for="">Coding</label>
                                <input type="text" required name="coding" value="0" class="form-control ">
                            </div>
                        </div>

                        <div class="form-row row">
                            <div class="col-md-12">
                                <label for="">Testing</label>
                                <input type="text" required name="testing" value="0" class="form-control ">
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="col-md-12">
                                <label for="">Project Management</label>
                                <input type="text" required name="project_management" value="0" placeholder="Name"
                                    class="form-control ">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save
                            changes</button>
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
            <h4 class="m-0 text-dark mb-2">Expended Hours</h4>
            <div class="row">
                <div class="col-12">
                    @php 
                    $sno = 0;
                    $analysis = $designing = $coding = $testing = $project_management = 0;
                    @endphp
                    @foreach ($spent_hours as $key => $publication)
                        <div class="card">
                            <h5 class="font-weight-bold card-header mt-2 mb-0">
                                {{ App\Models\Project::where('id', $key)->value('name') }}</h5>
                            <div class="card-body">
                                <table class="table table-sm table-bordered table-hover">
                                    <tr>
                                        <th>Date</th>
                                        <th>Analysis</th>
                                        <th>Designing</th>
                                        <th>Coding</th>
                                        <th>Testing</th>
                                        <th>Project management</th>
                                        <th>Action</th>
                                    </tr>

                                    @foreach ($publication as $row)
                                        @php
                                            $analysis += $row->analysis;
                                            $designing += $row->designing;
                                            $coding += $row->coding;
                                            $testing += $row->testing;
                                            $project_management += $row->project_management;
                                        @endphp
                                        <tr>
                                            <td>{{ $row->created_at }}</td>
                                            <td>{{ $row->analysis }}</td>
                                            <td>{{ $row->designing }}</td>
                                            <td>{{ $row->coding }}</td>
                                            <td>{{ $row->testing }}</td>
                                            <td>{{ $row->project_management }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#HourModal{{ $row->id }}"><span
                                                        class="fa fa-edit"></span></button>

                                                <a onclick="return confirm('are you sure?')"
                                                href="{{ route('delete_hours', $row->id) }}"
                                                class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="HourModal{{ $row->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Hours</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>

                                                    </div>

                                                    <form id="" action="{{ route('project.update_hours') }}"
                                                        enctype="multipart/form-data" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-row row">
                                                                <div class="col-md-12">
                                                                    <label for="">Project</label>
                                                                    <select name="project_id" required class="form-control" id="">
                                                                        <option value="">Please select</option>
                                                                        @foreach ($projects as $project)
                                                                            <option {{ $project->id == $row->project_id ? 'selected':'' }} value="{{ $project->id }}">{{ $project->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-row row">
                                                                <div class="col-md-12">
                                                                    <label for="">Analysis</label>
                                                                    <input type="text" required name="analysis"
                                                                        value="{{ $row->analysis }}" class="form-control ">
                                                                </div>
                                                            </div>
                                                           
                                                            <div class="form-row row">
                                                                <div class="col-md-12">
                                                                    <label for="">Designing</label>
                                                                    <input type="text" required name="designing"
                                                                        value="{{ $row->designing }}" class="form-control ">
                                                                </div>
                                                            </div>
                                                            <div class="form-row row">
                                                                <div class="col-md-12">
                                                                    <label for="">Coding</label>
                                                                    <input type="text" required name="coding"
                                                                        value="{{ $row->coding }}" class="form-control ">
                                                                </div>
                                                            </div>

                                                            <div class="form-row row">
                                                                <div class="col-md-12">
                                                                    <label for="">Testing</label>
                                                                    <input type="text" required name="testing"
                                                                        value="{{ $row->testing }}" class="form-control ">
                                                                </div>
                                                            </div>
                                                            <div class="form-row row">
                                                                <div class="col-md-12">
                                                                    <label for="">Project Management</label>
                                                                    <input type="text" required
                                                                        name="project_management" value="{{ $row->project_management }}"
                                                                        placeholder="Name" class="form-control ">
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


                                    <tr class="bg-light">
                                        <th class="text-center bg-light">Total Expended Hours</th>
                                        <th>{{ $analysis }}</th>
                                        <th>{{ $designing }}</th>
                                        <th>{{ $coding }}</th>
                                        <th>{{ $testing }}</th>
                                        <th>{{ $project_management }}</th>
                                        <th>-</th>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    @endforeach

                    <!-- /.card-header -->


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
                    i +
                    '" class="btn btn-danger btn-sm btn_remove"><span class="fa fa-trash"></span></button></td></tr>'
                );
            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

        })

        // $(".details").click(function() {
        //     p_id = $(this).data('project')

        //     $.ajax({
        //         type: "get",
        //         url: "{{ route('project.risks') }}",
        //         data: {project_id:p_id},
        //     }).done(function(data) {

        //         var risks = new Array();
        //         // $.each(data, function (arrayIndex, row) { 

        //         //     $(".risks"+p_id).html(row.name)
        //         // });

        //         $(".risks"+p_id, data).each(function (i,val) {
        //                 splashArray.push(val);
        //         });
        //             console.log('data',risks);
        //         }).fail(function(data) {

        //     });
        // })
    </script>
@endsection
