@extends("user.layouts.app")


@section("headSection")

<style type="text/css">


      .imgSehir {
        display: block;
        height: 150px;
        max-height: 150px;
        max-width: 100%;
        line-height: 1;
        margin:auto;
        width: 100%;
        overflow:hidden;

      }

</style>


@endsection


@section("main-content")



<div class="fh5co-listing">
        <div class="container">

        <h2 style=" border-bottom: 1px solid gray; padding-bottom:1em; "> Gitmek İstediğiniz Şehri Seçin </h2>


            <div class="row">
                @foreach($sehirler as $sehir)
                    <div class="col-md-4 fh5co-item-wrap">
                        <a class="fh5co-listing-item" href="{{route('sehir',$sehir->id)}}">
                            <img class="imgSehir" src="{{$sehir->images[0]->isim}}" alt="Resim yüklenemedi" class="img-responsive" style="width: 100%;height: 100%%">
                            <div class="fh5co-listing-copy">
                                <h2>{{$sehir->isim}}</h2>
                                <span class="icon">
                                    <i class="icon-chevron-right"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach


                <!-- END 3 row -->

            </div>
        </div>
    </div>
@endsection
