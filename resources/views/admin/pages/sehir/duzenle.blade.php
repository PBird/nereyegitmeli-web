
@extends("admin.layouts.app")

@section("headSection")


 <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.css')}}">
  <!-- blueimp Gallery styles -->
<link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
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
            <h1>Şehir Düzenle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('sehir.index')}}">Sehirler</a></li>
              <li class="breadcrumb-item active"> Şehir düzenle</li>
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
                    <h3 class="card-title">{{$sehir->isim}}</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form" id="olusturForm" action="{{route('sehir.update',$sehir->id)}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                  {{method_field('put')}}
                   <input type="hidden" id="markerAddress" name="markerAddress" value="@if(old('markerAddress')) {{old('markerAddress')}} @else {{$sehir->markerAddress}} @endif" >
                   <input type="hidden" id="position" name="position" value="@if(old('position')) {{old('position')}} @else {{$sehir->position}} @endif}}">


                    <div class="card-body">
                      <div class="form-group">
                        <label for="isim">İsim</label>
                        <input type="text" class="form-control" id="isim" name="isim" placeholder="Şehir ismi giriniz" value="@if(old('isim')) {{old('isim')}} @else {{$sehir->isim}} @endif">
                      </div>
                      <div class="form-group">
                        <label for="aciklama">Açıklama</label>
                        <input type="text" class="form-control" id="aciklama" name="aciklama" placeholder="Şehire neden gidilmesi gerektiğini anlatan kısa bir cümle giriniz" value="@if(old('aciklama')) {{old('aciklama')}} @else {{$sehir->aciklama}} @endif">
                      </div>

                        <div class="row">

                   <div class="col">

                       <div class="form-group ">

                       <div id="home" class="tab-pane  in ">
                        <label for="exampleInputFile">Sehir resmi</label>
                                 <div class="col-sm-6 col-md-4">

                                  <div class="thumbnail">
                                    <img id="sl0" src="{{$imgs[0]}}" alt="your image" />
                                    <div class="caption">
                                      <input type="file" class="custom-file-input" id="sehir_resmi" name="sehir_resmi" onchange="readURL(this,'sl0')" >
                                      <label class="custom-file-label" for="sehir_resmi" id="sehir_resmi_isim"></label>
                                    </div>
                                  </div>
                                </div>
                        </div>
                      </div>

                  </div>


                  <div class="col">

                       <div class="form-group ">
                       <div id="home" class="tab-pane  in ">
                         <label for="exampleInputFile">Slayt resim 1</label>
                                 <div class="col-sm-6 col-md-4">

                                  <div class="thumbnail">
                                    <img id="sl1" src="{{$imgs[1]}}" alt="your image" />
                                    <div class="caption">
                                      <input type="file" class="custom-file-input" id="slayt_resmi_1" name="slayt_resmi_1" onchange="readURL(this,'sl1')" >
                                      <label class="custom-file-label" for="slayt_resmi_1" id="slayt_resmi_1_isim"></label>
                                    </div>
                                  </div>
                                </div>
                        </div>
                      </div>

                  </div>
                  <div class="col">

                    <div class="form-group ">
                       <div id="home" class="tab-pane  in ">
                        <label for="exampleInputFile">Slayt resim 2</label>
                                 <div class="col-sm-6 col-md-4">

                                  <div class="thumbnail">
                                    <img id="sl2" src="{{$imgs[2]}}" alt="your image" />
                                    <div class="caption">
                                      <input type="file" class="custom-file-input" id="slayt_resmi_2" name="slayt_resmi_2" onchange="readURL(this,'sl2')" >
                                      <label class="custom-file-label" for="slayt_resmi_2" id="slayt_resmi_2_isim"></label>
                                    </div>
                                  </div>
                                </div>
                        </div>
                      </div>


                  </div>
                  <div class="col">


                      <div class="form-group">
                       <div id="home" class="tab-pane  in ">
                        <label for="exampleInputFile">Slayt resim 3</label>
                                 <div class="col-sm-6 col-md-4">
                                  <div class="thumbnail">
                                    <img id="sl3" src="{{$imgs[3]}}" alt="your image" />
                                    <div class="caption">
                                      <input type="file" class="custom-file-input" id="slayt_resmi_3" name="slayt_resmi_3" onchange="readURL(this,'sl3')" >
                                      <label class="custom-file-label" for="slayt_resmi_3" id="slayt_resmi_3_isim"></label>
                                    </div>
                                  </div>
                                </div>
                        </div>
                      </div>


                   </div>
                </div>




               </form>
               <div class="form-group form-inline ">

                          <input class="form-control mr-2" id="address" type="textbox" value="Türkiye @if(old('isim')) {{old('isim')}} @else {{$sehir->isim}} @endif" onkeydown="if (event.keyCode == 13) { geocodeAddress(geocoder, map);return false;}">
                          <input class="btn btn-secondary" id="submit" type="button" value="Geocode">
               </div>
                 <div id="map"></div>

                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary" form="olusturForm">Düzenle</button>
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
    if($('#sl1').attr("src")=='')
       $('#sl1').height(150).width(150).hide();
     else
      $('#sl1').height(150).width(150);
    if($('#sl2').attr("src")=='')
       $('#sl2').height(150).width(150).hide();
     else
      $('#sl2').height(150).width(150);
     if($('#sl3').attr("src")=='')
       $('#sl3').height(150).width(150).hide();
     else
      $('#sl3').height(150).width(150);
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