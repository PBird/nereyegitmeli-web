
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
            <h1>Şehirler</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Şehirler</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

       <div class="card">
            <div class="card-header text-center">

               <a class="col-lg-offset-5 btn btn-success" href="{{route('sehir.create')}}">Yeni Ekle</a>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Şehir Adı</th>
                  <th>Açıklama</th>
                  <th>Gezilecek Yerler</th>
                  <th>Oteller</th>
                  <th>Restoranlar</th>
                  <th>Tarihi Yerler</th>
                  <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sehirler as $sehir)
                <tr>
                  <td>{{$sehir->isim}}</td>
                  <td>{{$sehir->aciklama}}
                  </td>
                  <td class="text-center"> <a href="{{route('GezilebilecekYer.showGezilecekyerler',$sehir->id)}}"> {{$sehir->gezilebilecek_yers()->count()}}

                   <span class="ion-ios-eye" style="color: blue;"></span></a> </td>
                  <td class="text-center">
                  <a href=" {{route('Otel.showOteller',$sehir->id)}} " style="padding-right: 5px"> {{$sehir->otels()->count()}} <span class="ion-ios-eye" style="color: blue;"></span></a>
                  </td>
                  <td class="text-center"><a href=" {{route('Restoran.showRestoranlar',$sehir->id)}} "> {{$sehir->restorans()->count()}} <span class="ion-ios-eye" style="color: blue;"></span></a></td>
                  <td class="text-center"><a href=" {{route('TarihiYer.showTarihiYerler',$sehir->id)}} ">{{$sehir->tarihi_yers()->count() }} <span class="ion-ios-eye" style="color: blue;"></span></a></td>
                  <td class="text-center"> <form action="{{route('sehir.destroy',$sehir->id)}}" method="POST"> <button class="btn btn-block btn-danger btn-sm">Sil</button>
                  {{csrf_field()}}
                  {{ method_field('delete') }}
                  </form>
                     <a href="{{route('sehir.edit',$sehir->id)}}" class="btn btn-block btn-info btn-sm">Düzenle</a>
                   </td>
                </tr>
                @endforeach


                </tbody>
                <tfoot>
                <tr>
                  <th>Şehir Adı</th>
                  <th>Açıklama</th>
                  <th>Gezilecek Yerler</th>
                  <th>Oteller</th>
                  <th>Restoranlar</th>
                  <th>Tarihi Yerler</th>
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