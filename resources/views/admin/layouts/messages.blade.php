 @if (count($errors)>0)
                @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible"  id="alert{{$loop->index}}" style="top: calc(12% + 7.2em*{{$loop->index}});">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                  {{$error}}
                </div>


                @endforeach
 @endif


 @if(session('success'))

   <div class="alert alert-success alert-dismissible"  id="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> Başarılı!</h5>
                  {{session('success')}}
   </div>


 @endif

