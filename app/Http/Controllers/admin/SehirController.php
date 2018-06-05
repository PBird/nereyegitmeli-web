<?php

namespace App\Http\Controllers\admin;

use App\sehir;
use App\image;
use Storage;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class SehirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
         $sehirler = sehir::all();
         return view('admin.pages.sehir.sehirler')->with('sehirler',$sehirler);
    }

    public function listSehirler()
    {
         $sehirler = sehir::all();

         return view('user.list')->with('sehirler',$sehirler);
    }
    public function showSehir(sehir $sehir)
    {

         $name = Input::get('mekan', 'gezilebilecek_yer');
         $imgs = [];
         switch ($name) {
            case 'gezilebilecek_yer':
                $gezilebilecek_yerler = $sehir->gezilebilecek_yers()->get();
                foreach ($gezilebilecek_yerler as $key => $gezilebilecek_yer ) {
                    $imgs[$key] = url($gezilebilecek_yer->images()->get()->first()->isim);

                }
                 return view('user.city')->with('sehir',$sehir)->with('imgs',$imgs)->with('mekanlar',$gezilebilecek_yerler);

                break;
            case 'otel':
                $oteller = $sehir->otels()->get();
                foreach ($oteller as $key => $otel ) {
                    $imgs[$key] = url($otel->images()->get()->first()->isim);

                }
                 return view('user.city')->with('sehir',$sehir)->with('imgs',$imgs)->with('mekanlar',$oteller);

                break;
            case 'restoran':
                $restoranlar = $sehir->restorans()->get();
                foreach ($restoranlar as $key => $restoran ) {
                    $imgs[$key] = url($restoran->images()->get()->first()->isim);
                }

                 return view('user.city')->with('sehir',$sehir)->with('imgs',$imgs)->with('mekanlar',$restoranlar);

                break;

             case 'tarihi_yer':
            $tarihi_yerler = $sehir->tarihi_yers()->get();
            foreach ($tarihi_yerler as $key => $tarihi_yer ) {
                $imgs[$key] = url($tarihi_yer->images()->get()->first()->isim);

            }

             return view('user.city')->with('sehir',$sehir)->with('imgs',$imgs)->with('mekanlar',$tarihi_yerler);
            break;

            default:
                 # code...
                 break;
         }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.pages.sehir.olustur');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,
            ['isim'=> 'required' ,
            'aciklama' => 'required|max:144',
            'position' => 'required',
            'markerAddress' => 'required',
            'sehir_resmi' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slayt_resmi_1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slayt_resmi_2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slayt_resmi_3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']
            );
        $sehir = new sehir;

        $sehir->isim = $request->isim;
        $sehir->aciklama = $request->aciklama;
        $sehir->position = $request->position;
        $sehir->markerAddress = $request->markerAddress;
        $sehir->save();

        $sehir_resmi = $request->file('sehir_resmi');
        $sehir_resmi_name = $sehir->isim.'-'.md5($sehir->isim.time().'1').'.'.$sehir_resmi->getClientOriginalExtension();
        $destinationPath = public_path('/sehir_resimleri');
        $sehir_resmi->move($destinationPath, $sehir_resmi_name);

        $slayt_resmi_1 = $request->file('slayt_resmi_1');
        $slayt_resmi_1_name = $sehir->isim.'-'.md5($sehir->isim. time().'2').'.'.$slayt_resmi_1->getClientOriginalExtension();
        $destinationPath = public_path('/sehir_resimleri');
        $slayt_resmi_1->move($destinationPath, $slayt_resmi_1_name);

        $slayt_resmi_2 = $request->file('slayt_resmi_2');
        $slayt_resmi_2_name = $sehir->isim.'-'.md5($sehir->isim. time().'3').'.'.$slayt_resmi_2->getClientOriginalExtension();
        $destinationPath = public_path('/sehir_resimleri/');
        $slayt_resmi_2->move($destinationPath, $slayt_resmi_2_name);

        $slayt_resmi_3 = $request->file('slayt_resmi_3');
        $slayt_resmi_3_name = $sehir->isim.'-'.md5($sehir->isim. time().'4').'.'.$slayt_resmi_3->getClientOriginalExtension();
        $destinationPath = public_path('/sehir_resimleri');
        $slayt_resmi_3->move($destinationPath, $slayt_resmi_3_name);

         $images = [];
        for($i = 0;$i<4;$i++)
           $images[$i] = new image;

       $images[0]->isim = 'sehir_resimleri/'.$sehir_resmi_name;
       $images[1]->isim = 'sehir_resimleri/'.$slayt_resmi_1_name;
       $images[2]->isim = 'sehir_resimleri/'.$slayt_resmi_2_name;
       $images[3]->isim = 'sehir_resimleri/'.$slayt_resmi_3_name;

        for($i = 0;$i<4;$i++)
             $sehir->images()->save($images[$i]);


    return redirect()->route('sehir.index')->withSuccess('Şehir eklendi');
      }

      public function getJson(sehir $sehir=null,$mekan=null){
        $header = array (
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );
        $responsecode = 200;

        if(!$sehir)
        {
            return response()->json(sehir::all(),$responsecode, $header, JSON_UNESCAPED_UNICODE);
        }
        else
        {

                 switch ($mekan) {
                    case 'otel':
                       return response()->json($sehir->otels()->get(),$responsecode, $header, JSON_UNESCAPED_UNICODE);
                        break;
                    case 'restoran':
                        return response()->json($sehir->restorans()->get(),$responsecode, $header, JSON_UNESCAPED_UNICODE);
                    case 'tarihiyer':
                        return response()->json($sehir->tarihi_yers()->get(),$responsecode, $header, JSON_UNESCAPED_UNICODE);
                    case 'gezilecekyer':
                        return response()->json($sehir->gezilebilecek_yers()->get(),$responsecode, $header, JSON_UNESCAPED_UNICODE);

                    default:
                        return "Lütfen url yi kontrol edin.";
                        break;
                }

        }

      }
      public function getimg(sehir $sehir=null,$mekan=null,$mekanid=null){
        $header = array (
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );
        $responsecode = 200;

        if(!$mekan)
        {
            $links= $sehir->images()->pluck('isim');
            for ($i=0;count($links)>$i;$i++)
                $links[$i] = url($links[$i]);
            return response()->json(['links' => $links],$responsecode, $header, JSON_UNESCAPED_UNICODE);
        }
        else
        {
            if($mekanid)
            {
                 switch ($mekan) {
                    case 'otel':
                        $links = $sehir->otels()->find($mekanid)->images()->pluck('isim');
                        for ($i=0;count($links)>$i;$i++)
                             $links[$i] = url($links[$i]);

                       return response()->json(['link'=> $links ],$responsecode, $header, JSON_UNESCAPED_UNICODE);
                        break;
                    case 'restoran':
                        $links = $sehir->restorans()->find($mekanid)->images()->pluck('isim');
                        for ($i=0;count($links)>$i;$i++)
                             $links[$i] = url($links[$i]);
                        return response()->json(['link'=> $links ],$responsecode, $header, JSON_UNESCAPED_UNICODE);
                    case 'tarihiyer':
                        $links = $sehir->tarihi_yers()->find($mekanid)->images()->pluck('isim');
                        for ($i=0;count($links)>$i;$i++)
                            $links[$i] = url($links[$i]);
                        return response()->json(['link'=> $links ],$responsecode, $header, JSON_UNESCAPED_UNICODE);
                    case 'gezilecekyer':
                        $links = $sehir->gezilebilecek_yers()->find($mekanid)->images()->pluck('isim');
                        for ($i=0;count($links)>$i;$i++)
                            $links[$i] = url($links[$i]);
                        return response()->json(['link'=> $links ],$responsecode, $header, JSON_UNESCAPED_UNICODE);

                    default:
                        return "Lütfen url yi kontrol edin.";
                        break;
                }

            }

        }

      }







    /**
     * Display the specified resource.
     *
     * @param  \App\sehir  $sehir
     * @return \Illuminate\Http\Response
     */
    public function show(sehir $sehir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sehir  $sehir
     * @return \Illuminate\Http\Response
     */
    public function edit(sehir $sehir)
    {


        $imgs = $sehir->images()->pluck('isim');
        for ($i=0;count($imgs)>$i;$i++)
                $imgs[$i] = url($imgs[$i]);
        return view('admin.pages.sehir.duzenle')->with('sehir',$sehir)->with('imgs',$imgs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sehir  $sehir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sehir $sehir)
    {



          $this->validate($request,
            ['isim'=> 'required' ,
            'aciklama' => 'required|max:144',
            'position' => 'required',
            'markerAddress' => 'required',
            'sehir_resmi' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slayt_resmi_1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slayt_resmi_2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slayt_resmi_3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']
            );

        if(!$sehir)
            return "Hata";
        $sehir->isim = $request->isim;
        $sehir->aciklama = $request->aciklama;
        $sehir->position = $request->position;
        $sehir->markerAddress = $request->markerAddress;
        $sehir->save();

        $images = $sehir->images;

        if($request->file('sehir_resmi'))
        {
            $sehir_resmi = $request->file('sehir_resmi');
            $sehir_resmi_name = $sehir->isim.'-'.md5($sehir->isim.time().'1').'.'.$sehir_resmi->getClientOriginalExtension();
            $destinationPath = public_path('/sehir_resimleri');
            $sehir_resmi->move($destinationPath, $sehir_resmi_name);
            //dosya burda silinecek
            if(file_exists($images[0]->isim))
                 unlink($images[0]->isim);
            $images[0]->isim = 'sehir_resimleri/'.$sehir_resmi_name;
        }

        if($request->file('slayt_resmi_1'))
        {
            $slayt_resmi_1 = $request->file('slayt_resmi_1');
            $slayt_resmi_1_name = $sehir->isim.'-'.md5($sehir->isim. time().'2').'.'.$slayt_resmi_1->getClientOriginalExtension();
            $destinationPath = public_path('/sehir_resimleri');
            $slayt_resmi_1->move($destinationPath, $slayt_resmi_1_name);
            //dosya burda silinecek
            if(file_exists($images[1]->isim))
                unlink($images[1]->isim);
             $images[1]->isim = 'sehir_resimleri/'.$slayt_resmi_1_name;
       }

        if($request->file('slayt_resmi_2'))
        {
            $slayt_resmi_2 = $request->file('slayt_resmi_2');
            $slayt_resmi_2_name = $sehir->isim.'-'.md5($sehir->isim. time().'3').'.'.$slayt_resmi_2->getClientOriginalExtension();
            $destinationPath = public_path('/sehir_resimleri/');
            $slayt_resmi_2->move($destinationPath, $slayt_resmi_2_name);
            //dosya burda silinecek
            if(file_exists($images[2]->isim))
                unlink($images[2]->isim);
            $images[2]->isim = 'sehir_resimleri/'.$slayt_resmi_2_name;
        }

        if($request->file('slayt_resmi_3'))
        {
            $slayt_resmi_3 = $request->file('slayt_resmi_3');
            $slayt_resmi_3_name = $sehir->isim.'-'.md5($sehir->isim. time().'4').'.'.$slayt_resmi_3->getClientOriginalExtension();
            $destinationPath = public_path('/sehir_resimleri');
            $slayt_resmi_3->move($destinationPath, $slayt_resmi_3_name);
            // dosya burda silinecek
            if(file_exists($images[3]->isim))
                unlink($images[3]->isim);
            $images[3]->isim = 'sehir_resimleri/'.$slayt_resmi_3_name;
        }


        for($i = 0;$i<4;$i++)
             $sehir->images()->save($images[$i]);



    return redirect()->route('sehir.index')->withSuccess('Şehir Düzenlendi');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sehir  $sehir
     * @return \Illuminate\Http\Response
     */
    public function destroy(sehir $sehir)
    {
         $images = $sehir->images;
         for($i = 0 ; $i<count($images);$i++)
         {
            if(file_exists($images[$i]->isim))
                unlink($images[$i]->isim);
         }

         $sehir->delete();

         return redirect()->route('sehir.index')->withSuccess('Şehir silindi');
    }
}
