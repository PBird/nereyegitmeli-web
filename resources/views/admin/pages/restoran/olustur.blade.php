
@extends("admin.layouts.app")

@section("headSection")


 <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.css')}}">
  <!-- blueimp Gallery styles -->
<link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.min.css">
<style type="text/css">

  #map {
        width: 720px;
        height: 320px;
    }

</style>

@endsection

@section("main-content")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

 @include('admin.layouts.messages')

   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>#{{$sehir->isim}} - Restoranlar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('sehir.index')}}">Sehirler</a></li>
              <li class="breadcrumb-item"><a href="{{route('Restoran.showRestoranlar',$sehir->id)}}">#{{$sehir->isim}}- Restoranlar</a></li>
              <li class="breadcrumb-item active">Restoran oluştur </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="card">

            <!-- /.card-header -->
            <div class="card-body">

              <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Yeni Restoran</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form" id="olusturForm" action="{{route('restoran.store')}}" method="POST" enctype="multipart/form-data">

                  {{csrf_field()}}
                   <input type="hidden" id="markerAddress" name="markerAddress" value="{{ old('markerAddress') }}">
                   <input type="hidden" id="position" name="position" value="{{ old('position') }}">
                  <input type="hidden" name="sehir" value="{{$sehir->id}}">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="isim">İsim</label>
                        <input type="text" class="form-control" id="isim" name="isim" placeholder="Restoran ismini giriniz" value="{{ old('isim') }}">
                      </div>
                      <div class="form-group">
                          <label>Adres</label>
                          <textarea class="form-control" rows="3" placeholder="Adresi giriniz" name="adres">{{ old('adres') }}</textarea>
                      </div>

                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        </div>

                        <input type="text" class="form-control bfh-phone" data-format="+0 (ddd) ddd-dddd"  name="telefon" value="{{ old('telefon') }}">
                      </div>

                      <div class="form-group">
                        <label for="aciklama">Kısa Açıklama</label>
                        <input type="text" class="form-control" id="aciklama" name="kisaaciklama" placeholder="Kısa açıklama" value="{{ old('kisaaciklama') }}">
                      </div>
                       <div class="form-group">
                        <label for="aciklama">Uzun Açıklama</label>
                        <textarea class="form-control" rows="3" placeholder="Uzun açıklam" name="uzunaciklama">{{ old('uzunaciklama') }}</textarea>
                      </div>

                       <div class="form-group ">

                       <div id="home" class="tab-pane  in ">
                        <label for="exampleInputFile">Restoran resmi</label>
                                 <div class="col-sm-6 col-md-4">

                                  <div class="thumbnail">
                                    <img id="sl0" src="" alt="your image" />
                                    <div class="caption">
                                      <input type="file" class="custom-file-input" id="resim" name="resim" onchange="readURL(this,'sl0')" >
                                      <label class="custom-file-label" for="resim" id="resim_isim" ></label>
                                    </div>
                                  </div>
                                </div>
                        </div>
                      </div>

               </form>
               <div class="form-group form-inline ">

                          <input class="form-control mr-2" id="address" type="textbox" value="{{$sehir->isim}}" onkeydown="if (event.keyCode == 13) { geocodeAddress(geocoder, map);return false;}">
                          <input class="btn btn-secondary" id="submit" type="button" value="Geocode">
               </div>
                 <div id="map"></div>

                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary" form="olusturForm">Ekle</button>
                    </div>




            </div>

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


<script type="text/javascript">
 checkImg();
  function checkImg() {

    if($('#sl0').attr("src")=='')
       $('#sl0').hide();
     else
      $('#sl0').height(150).width(150);
  }


//show image
  function readURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#'+id)
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150).show();
            };

            reader.readAsDataURL(input.files[0]);
        }

    }


</script>

<!-- InputMask -->
<script src="{{asset('admin/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('admin/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js" type="text/javascript"></script>

<script type="text/javascript">
       @foreach($errors->all() as $error)
         $('#alert{{$loop->index}}').delay("{{$loop->index+1}}"*1000).fadeOut(1000,"swing");
      @endforeach

</script>

 <script>

 var markerAddress = document.getElementById("markerAddress");
 var position = document.getElementById("position");
 var marker = null;
 var map ;
 var geocoder
  function initMap() {
         map = new google.maps.Map(document.getElementById('map'), {
          zoom: 5,
          center: {lat: 38.978130, lng: 35.221831}
        });
        geocoder = new google.maps.Geocoder();
          geocodeAddress(geocoder, map);
        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            if(marker)
                 marker.setMap(null);
             marker = null;
             marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location,
              animation: google.maps.Animation.DROP
            });

            position.value = marker.position;
            markerAddress.value = results[0].formatted_address;
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }

        });
      }


      function preventSubmitAdressMark(){
        if (event.keyCode == 13) { alert('enter');return false;}
      }



    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAodkJkmzxL44Zkkgqkdjuo0hiv--enUvE&callback=initMap">
   </script>


@endsection