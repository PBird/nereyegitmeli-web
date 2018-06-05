
@extends("admin.layouts.app")

@section("headSection")
 <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section("main-content")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   @include('admin.layouts.messages')

   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>   #{{$sehir->isim}} - Tarihi Yerler -</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('sehir.index')}}">Sehirler</a></li>
              <li class="breadcrumb-item active">Tarihi Yerler </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

       <div class="card">
            <div class="card-header text-center">

               <a class="col-lg-offset-5 btn btn-success" href="{{route('TarihiYer.createTarihiYerler',$sehir->id)}}">Yeni Ekle</a>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Tarihi Yer Adı</th>
                  <th>Adres</th>
                  <th>Telefon</th>
                  <th>Kısa Açıklama</th>
                  <th>Uzun Açıklama</th>
                  <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tarihi_yerler as $tarihi_yer)
                <tr>
                  <td>{{$tarihi_yer->isim}}</td>
                  <td>{{$tarihi_yer->adres}}
                  </td>
                  <td class="text-center"> {{$tarihi_yer->phone}} </td>
                  <td class="text-center">
                  {{$tarihi_yer->kisaaciklama}}
                  </td>
                  <td class="text-center">{{str_limit($tarihi_yer->uzunaciklama)}} </td>
                  <td class="text-center"> <form action="{{route('TarihiYer.destroy',$tarihi_yer->id)}}" method="POST"> <button class="btn btn-block btn-danger btn-sm">Sil</button>
                  {{csrf_field()}}
                  {{ method_field('delete') }}
                  </form>
                <a href="{{route('TarihiYer.edit',$tarihi_yer->id)}}" class="btn btn-block btn-info btn-sm">Düzenle</a></td>
                </tr>
                @endforeach


                </tbody>
                <tfoot>
                <tr>
                  <th>Tarihi Yer Adı</th>
                  <th>Adres</th>
                  <th>Telefon</th>
                  <th>Kısa Açıklama</th>
                  <th>Uzun Açıklama</th>
                  <th>İşlemler</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->






    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@section("scripts")
  <!-- DataTables -->
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
          "dom": '<"top pull-right"f><"clear"><"top pull-left"l> <"clear" t>p <"pull-right"i>'
    });
  });
</script>
@endsection