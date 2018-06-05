<?php

namespace App\Http\Controllers\admin;

use App\otel;
use App\sehir;
use App\image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OtelController extends Controller
{



    public function showOtel(sehir $sehir){

        $oteller = $sehir->otels()->get();


        return view('admin.pages.otel.otel')->with('oteller',$oteller)->with('sehir',$sehir);

    }
    public function createOtel(sehir $sehir){

            return view('admin.pages.otel.olustur')->with('sehir',$sehir);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'kisaaciklama' => 'required|max:144',
             'uzunaciklama' => 'required',
             'telefon' => 'required|max:17',
             'position' => 'required',
             'markerAddress' => 'required',
             'adres' => 'required',
            'resim' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sehir' => 'required'
            ]
            );

          $otel = new otel;
          $otel->isim = $request->isim;
          $otel->kisaaciklama = $request->kisaaciklama;
          $otel->uzunaciklama =  $request->uzunaciklama;
          $otel->phone = $request->telefon;
          $otel->adres = $request->adres;
          $otel->position = $request->position;
          $otel->markerAddress = $request->markerAddress;

          $resim = $request->file('resim');
          $resim_name = $request->isim.'-'.md5($request->isim.time().'1').'.'.$resim->getClientOriginalExtension();
          $destinationPath = public_path('/otel_resimleri/');
          $resim->move($destinationPath, $resim_name);
          $image = new image;
          $image->isim = 'otel_resimleri/'.$resim_name;

          $sehir = sehir::find($request->sehir);
          $sehir->otels()->save($otel);
          $otel->images()->save($image);

          return redirect()->route('Otel.showOteller',$sehir)->withSuccess('Otel eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\otel  $otel
     * @return \Illuminate\Http\Response
     */
    public function show(otel $otel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\otel  $otel
     * @return \Illuminate\Http\Response
     */
    public function edit(otel $otel)
    {
         $imgs = $otel->images()->pluck('isim');
        for ($i=0;count($imgs)>$i;$i++)
                $imgs[$i] = url($imgs[$i]);
         $sehir = sehir::where('id',$otel->sehir_id)->first();

        return view('admin.pages.otel.duzenle')->with('otel',$otel)->with('imgs',$imgs)->with('sehir',$sehir);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\otel  $otel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, otel $otel)
    {
        $this->validate($request,
            ['isim'=> 'required' ,
            'kisaaciklama' => 'required|max:144',
             'uzunaciklama' => 'required',
             'telefon' => 'required|max:17',
             'position' => 'required',
             'markerAddress' => 'required',
             'adres' => 'required',
            'resim' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sehir' => 'required'
            ]
            );

          $otel->isim = $request->isim;
          $otel->kisaaciklama = $request->kisaaciklama;
          $otel->uzunaciklama =  $request->uzunaciklama;
          $otel->phone = $request->telefon;
          $otel->adres = $request->adres;
          $otel->position = $request->position;
          $otel->markerAddress = $request->markerAddress;

           $images = $otel->images;

           if($request->file('resim'))
          {
            $resim = $request->file('resim');
            $resim_name = $request->isim.'-'.md5($request->isim.time().'1').'.'.$resim->getClientOriginalExtension();
            $destinationPath = public_path('/otel_resimleri/');
            $resim->move($destinationPath, $resim_name);

            if(file_exists($images[0]->isim))
                 unlink($images[0]->isim);

             $images[0]->isim = 'otel_resimleri/'.$resim_name;

          }


          $sehir = sehir::find($request->sehir);
          $sehir->otels()->save($otel);
          $otel->images()->save($images[0]);

          return redirect()->route('Otel.showOteller',$sehir)->withSuccess('Otel düzenlendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\otel  $otel
     * @return \Illuminate\Http\Response
     */
    public function destroy(otel $otel)
    {
         $images = $otel->images;



         for($i = 0 ; $i<count($images);$i++)
         {
            if(file_exists($images[$i]->isim))
                unlink($images[$i]->isim);
         }

          $otel->delete();
        return redirect()->back()->withSuccess('Otel silindi');
    }
}
