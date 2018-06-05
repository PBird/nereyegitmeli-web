<!DOCTYPE html>
<html>


 @include("admin.layouts.head")



<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
    @include("admin.layouts.nav")
  <!-- /.navbar -->

  @include("admin.layouts.slider")

  @section("main-content")
      @show


  @include("admin.layouts.footer")

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->




<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('admin/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('admin/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/js/adminlte.min.js')}}"></script>

<script type="text/javascript">
       @foreach($errors->all() as $error)
         $('#alert{{$loop->index}}').delay("{{$loop->index+1}}"*1000).fadeOut(1000,"swing");
      @endforeach
      @if(session('success'))
        $('#alert').delay(1000).fadeOut(1000,"swing");
      @endif

</script>


@section("scripts")
  @show
</body>
</html>
