
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>Dashboard -  </title>
  
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/all.min.css">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/plugins/summernote/summernote-bs4.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote.css') }}">
  <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  </head>
  <body class="hold-transition sidebar-mini">
  <div class="wrapper">
  
  
  @yield('content')
  
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      {{-- App name --}}
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2022 - {{ date('Y') }} </strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets') }}/dist/js/adminlte.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/summernote.js') }}"></script>
<!-- Page Script -->

<script>
  
  $(function () {
    
    $('.textarea').summernote()
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

    
    @if($message = Session::get('success'))
        toastr.options =
        {
          "closeButton" : true,
          "progressBar" : true
        }
        toastr.success("{{ $message }}");
    @endif

    @if($message = Session::get('error'))
        toastr.options =
        {
          "closeButton" : true,
          "progressBar" : true
        }
        toastr.error("{{ $message }}");
    @endif

    @if($message = Session::get('errors'))
        toastr.options =
        {
          "closeButton" : true,
          "progressBar" : true
        }
        toastr.error("{{ $message }}");
    @endif


    
  </script>
   <script>
    function randomString() {  
    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZDEFGHIJKLMNOPQRSTUCDEFGHIJK0123456789";  
  
    var string_length = 16;  
    var randomstringGenerator = '';  
  
    for (var i=0; i<string_length; i++) {  
        var rnum = Math.floor(Math.random() * chars.length);  
        randomstringGenerator += chars.substring(rnum,rnum+1);  
    }  

    $("#license").val(randomstringGenerator).addClass("text-uppercase")
    // document.getElementById("randomfield").innerHTML = randomstringGenerator;  
  } 
  </script>
</body>
</html>
