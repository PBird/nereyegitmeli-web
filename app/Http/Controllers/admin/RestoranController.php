<?php

namespace App\Http\Controllers\admin;

use App\restoran;
use App\sehir;
use App\image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestoranController extends Controller
{

     public function showRestoran(sehir $sehir){

        $restoranlar = $sehir->restorans()->get();


        return view('admin.pages.restoran.restoran')->with('restoranlar',$restoranlar)->with('sehir',$sehir);

    }
    public function createRestoran(sehir $sehir){

            return view('admin.pages.restoran.olustur')->with('sehir',$sehir);
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

          $restoran = new restoran;
          $restoran->isim = $request->isim;
          $restoran->kisaaciklama = $request->kisaaciklama;
          $restoran->uzunaciklama =  $request->uzunaciklama;
          $restoran->phone = $request->telefon;
          $restoran->adres = $request->adres;
          $restoran->position = $request->position;
          $restoran->markerAddress = $request->markerAddress;

          $resim = $request->file('resim');
          $resim_name = $request->isim.'-'.md5($request->isim.time().'1').'.'.$resim->getClientOriginalExtension();
          $destinationPath = public_path('/restoran_resimleri/');
          $resim->move($destinationPath, $resim_name);
          $image = new image;
          $image->isim = 'restoran_resimleri/'.$resim_name;

          $sehir = sehir::find($request->sehir);
          $sehir->restorans()->save($restoran);
          $restoran->images()->save($image);

          return redirect()->route('Restoran.showRestoranlar',$sehir)->withSuccess('Restoran eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\restoran  $restoran
     * @return \Illuminate\Http\Response
     */
    public function show(restoran $restoran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\restoran  $restoran
     * @return \Illuminate\Http\Response
     */
    public function edit(restoran $restoran)
    {
         $imgs = $restoran->images()->pluck('isim');
        for ($i=0;count($imgs)>$i;$i++)
                $imgs[$i] = url($imgs[$i]);
         $sehir = sehir::where('id',$restoran->sehir_id)->first();

        return view('admin.pages.restoran.duzenle')->with('restoran',$restoran)->with('imgs',$imgs)->with('sehir',$sehir);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\restoran  $restoran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, restoran $restoran)
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

          $restoran->isim = $request->isim;
          $restoran->kisaaciklama = $request->kisaaciklama;
          $restoran->uzunaciklama =  $request->uzunaciklama;
          $restoran->phone = $request->telefon;
          $restoran->adres = $request->adres;
          $restoran->position = $request->position;
          $restoran->markerAddress = $request->markerAddress;

          $images = $restoran->images;

          if($request->file('resim'))
          {
              $resim = $request->file('resim');
              $resim_name = $request->isim.'-'.md5($request->isim.time().'1').'.'.$resim->getClientOriginalExtension();
              $destinationPath = public_path('/restoran_resimleri/');
              $resim->move($destinationPath, $resim_name);

              if(file_exists($images[0]->isim))
                 unlink($images[0]->isim);
              $images[0]->isim = 'restoran_resimleri/'.$resim_name;
          }


          $sehir = sehir::find($request->sehir);
          $sehir->restorans()->save($restoran);
          $restoran->images()->save($images[0]);

          return redirect()->route('Restoran.showRestoranlar',$sehir)->withSuccess('Restoran düzenlendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\restoran  $restoran
     * @return \Illuminate\Http\Response
     */
    public function destroy(restoran $restoran)
    {
          $images = $restoran->images;
         for($i = 0 ; $i<count($images);$i++)
         {
            if(file_exists($images[$i]->isim))
                unlink($images[$i]->isim);
         }

        $restoran->delete();
        return redirect()->back()->withSuccess('restoran silindi');
    }
}
