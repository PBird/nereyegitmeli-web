@extends("user.layouts.app")

@section("headSection")

  <link rel="stylesheet" href={{asset('user/css/galery.css')}}>
  <style type="text/css">
    .siteBack {
      background: url("{{asset('user/images/hdiskenderun.jpg')}}");
         background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
      width: 100%;
    height: 100%;


    }

  </style>
@endsection



@section("main-content")

<div class="row">
    <div class="fh5co-hero">
            <div class="fh5co-overlay"></div>
            <div class="fh5co-cover text-center siteBack" data-stellar-background-ratio="0.5">
                <div class="desc animate-box">
                    <h2> Sen Sadece Gezmek İste  </h2>

                    <span><a class="btn btn-primary btn-lg" href="{{route('sehirler')}}">Gezmeye Başla</a></span>
                </div>
            </div>

    </div>
</div>




<div class="fh5co-section">
<div class="container">
    <div class="row">

        <h3 class="text-center" style="height:2em "> En Çok Ziyaret Edilen Yerler </h3>
        <div class="col-md-4  vcenter ">
            <br>
            <br>
            <br>
            <br>
            <p class="text-center" > Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus commodi, ex culpa at voluptas cumque eligendi quaerat obcaecati. Enim quaerat laborum quod et, excepturi earum voluptate harum ex iure sed. </p>


        </div>
        <div class="col-md-8">
            <div class="gallery">
                  <figure>
                    <img src="https://images.unsplash.com/photo-1448814100339-234df1d4005d?crop=entropy&fit=crop&fm=jpg&h=400&ixjsv=2.1.0&ixlib=rb-0.3.5&q=80&w=600" alt="" />
                    <figcaption>Daytona Beach <small>United States</small></figcaption>
                  </figure>
                  <figure>
                    <img src="https://images.unsplash.com/photo-1443890923422-7819ed4101c0?crop=entropy&fit=crop&fm=jpg&h=400&ixjsv=2.1.0&ixlib=rb-0.3.5&q=80&w=600" alt="" />
                    <figcaption>Териберка, gorod Severomorsk <small>Russia</small></figcaption>
                  </figure>
                  <figure>
                    <img src="https://images.unsplash.com/photo-1445964047600-cdbdb873673d?crop=entropy&fit=crop&fm=jpg&h=400&ixjsv=2.1.0&ixlib=rb-0.3.5&q=80&w=600" alt="" />
                    <figcaption>
                      Bad Pyrmont <small>Deutschland</small>
                    </figcaption>
                  </figure>
                  <figure>
                    <img src="https://images.unsplash.com/photo-1439798060585-62ab242d7724?crop=entropy&fit=crop&fm=jpg&h=400&ixjsv=2.1.0&ixlib=rb-0.3.5&q=80&w=600" alt="" />
                    <figcaption>Yellowstone National Park <small>United States</small></figcaption>
                  </figure>
                  <figure>
                    <img src="https://images.unsplash.com/photo-1440339738560-7ea831bf5244?crop=entropy&fit=crop&fm=jpg&h=400&ixjsv=2.1.0&ixlib=rb-0.3.5&q=80&w=600" alt="" />
                    <figcaption>Quiraing, Portree <small>United Kingdom</small></figcaption>
                  </figure>
                  <figure>
                    <img src="https://images.unsplash.com/photo-1441906363162-903afd0d3d52?crop=entropy&fit=crop&fm=jpg&h=400&ixjsv=2.1.0&ixlib=rb-0.3.5&q=80&w=600" alt="" />
                    <figcaption>Highlands <small>United States</small></figcaption>
                  </figure>
            </div>
        </div>
    </div>
<div class="container">



    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display:none;">
          <symbol id="close" viewBox="0 0 18 18">
            <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M9,0.493C4.302,0.493,0.493,4.302,0.493,9S4.302,17.507,9,17.507
                    S17.507,13.698,17.507,9S13.698,0.493,9,0.493z M12.491,11.491c0.292,0.296,0.292,0.773,0,1.068c-0.293,0.295-0.767,0.295-1.059,0
                    l-2.435-2.457L6.564,12.56c-0.292,0.295-0.766,0.295-1.058,0c-0.292-0.295-0.292-0.772,0-1.068L7.94,9.035L5.435,6.507
                    c-0.292-0.295-0.292-0.773,0-1.068c0.293-0.295,0.766-0.295,1.059,0l2.504,2.528l2.505-2.528c0.292-0.295,0.767-0.295,1.059,0
                    s0.292,0.773,0,1.068l-2.505,2.528L12.491,11.491z"/>
          </symbol>
    </svg>
</div>






    </div>
    <!-- END fh5co-page -->

    </div>
    <!-- END fh5co-wrapper -->

    <!-- jQuery -->





@endsection

@section("scripts")

<!-- galery -->
    <script src="{{asset('user/js/galery.js')}}"></script>


@endsection