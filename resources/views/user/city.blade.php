@extends("user.layouts.app")

@section("headSection")

<style type="text/css">

    .carousel-inner>.item>img, .carousel-inner>.item>a>img {
        display: block;
        height: 524px;
        max-height: 524px;
        max-width: 100%;
        line-height: 1;
        margin:auto;
        width: 100%;
        overflow:hidden;
        }

      .imgModal {
        display: block;
        height: 560px;
        max-height: 524px;
        max-width: 100%;
        line-height: 1;
        margin:auto;
        width: 100%;
        overflow:hidden;

      }

      .imgcard {
        display: block;
        height: 165px;
        max-height: 165px;
        max-width: 100%;
        line-height: 1;
        margin:auto;
        width: 100%;
        overflow:hidden;

      }

</style>


@endsection

@section("main-content")
@if(!isset($_GET['mekan']))
    <?php $_GET['mekan']='gezilebilecek_yer' ?>
@endif
<div class="fh5co-listing">
    <div class="container" >

        <div class="row">

                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                       <div class="carousel-top-caption">
                            <h1>{{$sehir->isim}}</h1>
                        </div>

                        <div class="carousel-caption">
                            <p>{{$sehir->aciklama}}</p>
                          </div>


                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                        <div class="item active">
                          <img src="{{url($sehir->images[1]->isim)}}" alt="Chania" >
                        </div>

                        <div class="item">
                          <img src="{{url($sehir->images[2]->isim)}}" alt="Chicago" >
                        </div>

                        <div class="item">
                          <img src="{{url($sehir->images[3]->isim)}}" alt="New York" >
                        </div>
                      </div>

                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                      </a>
                 </div>
        </div>

        <div class="row">

                <div class="container">

                    <div class="col-md-3">
                         <ul class="nav nav-pills nav-stacked">
                              <li class="@if($_GET['mekan']=='gezilebilecek_yer') active @endif"><a  href="{{route('sehir',$sehir->id)}}/?mekan=gezilebilecek_yer">Gezilebilecek Yerler</a></li>
                              <li class="@if($_GET['mekan']=='restoran') active @endif"><a href="{{route('sehir',$sehir->id)}}/?mekan=restoran">Restoranlar</a></li>
                              <li class="@if($_GET['mekan']=='tarihi_yer') active @endif"><a  href="{{route('sehir',$sehir->id)}}/?mekan=tarihi_yer"> Tarihi Yerler </a></li>
                              <li class="@if($_GET['mekan']=='otel') active @endif"><a  href="{{route('sehir',$sehir->id)}}/?mekan=otel"> Oteller </a></li>
                        </ul>
                    </div>

                        <div class="col-md-9">
                            <div class="tab-content">

                              @foreach($mekanlar as $key=>$mekan)
                            @if($key%3 == 0)
                                    <div class="row">
                            @endif
                                      <div class="col-sm-6 col-md-4">
                                        <div class="thumbnail">
                                          <img class="imgcard" src="{{$imgs[$key]}}" alt="...">
                                          <div class="caption">
                                            <h3 style="height: 51px;max-height: 51px">{{$mekan->isim}}</h3>
                                            <p style="height: 50px;max-height: 50px">{{str_limit($mekan->kisaaciklama,70)}}</p>
                                            <p><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal{{$key}}">
      Detaylar &#62;
    </button></p>
                                          </div>
                                        </div>
                                      </div>
                                  @if(($key+1)%3==0)
                                        </div>
                                  @endif

                             @endforeach



                            </div>
                       </div>
                </div>
        </div>
    </div>
</div>

<!-- Modal -->

@foreach($mekanlar as $key=>$mekan)
  <div class="modal fade" id="modal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
              <div class="thumbnail" id="sehir-popup">
                    <img class="imgModal" src="{{$imgs[$key]}}" alt="...">
                    <div class="caption">
                      <h3>{{$mekan->isim}}</h3>
                      <h4>Açıklama</h5>
                      <p>{{$mekan->uzunaciklama}}</p>
                      <hr>
                      <p >Telefon : {{$mekan->phone}}</p>
                      <hr>
                      <p >Adres : {{$mekan->adres}}</p>
                      <button type="button" class="btn btn-secondary " data-dismiss="modal">Kapat</button>
                    </div>
              </div>

        </div>
      </div>
    </div>
  </div>
@endforeach


@endsection

@section('scripts')

<script>
    $(document).ready(function(){
    $("#restoran).click(function(){
        $.get("14/", function(data, status){
            alert("Data: " + data + "\nStatus: " + status);
        });
    });
});
</script>


@endsection
