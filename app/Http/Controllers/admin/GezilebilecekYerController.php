<?php

namespace App\Http\Controllers\admin;

use App\gezilebilecek_yer;
use App\sehir;
use App\image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GezilebilecekYerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showGezilecekyer(sehir $sehir){

        $gezilebilecek_yerler = $sehir->gezilebilecek_yers()->get();


        return view('admin.pages.gezilecek_yer.gezilecek_yer')->with('gezilebilecek_yerler',$gezilebilecek_yerler)->with('sehir',$sehir);

    }
    public function createGezilecekyer(sehir $sehir){

            return view('admin.pages.gezilecek_yer.olustur')->with('sehir',$sehir);
    }


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
             'position' => 'required',
             'markerAddress' => 'required',
             'telefon' => 'required|max:17',
             'adres' => 'required',
            'resim' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sehir' => 'required'
            ]
            );

          $gezilebilecek_yer = new gezilebilecek_yer;
          $gezilebilecek_yer->isim = $request->isim;
          $gezilebilecek_yer->kisaaciklama = $request->kisaaciklama;
          $gezilebilecek_yer->uzunaciklama =  $request->uzunaciklama;
          $gezilebilecek_yer->phone = $request->telefon;
          $gezilebilecek_yer->adres = $request->adres;
          $gezilebilecek_yer->position = $request->position;
          $gezilebilecek_yer->markerAddress = $request->markerAddress;

          $resim = $request->file('resim');
          $resim_name = $request->isim.'-'.md5($request->isim.time().'1').'.'.$resim->getClientOriginalExtension();
          $destinationPath = public_path('/gezilecekyer_resimleri/');
          $resim->move($destinationPath, $resim_name);
          $image = new image;
          $image->isim = 'gezilecekyer_resimleri/'.$resim_name;

          $sehir = sehir::find($request->sehir);
          $sehir->gezilebilecek_yers()->save($gezilebilecek_yer);
          $gezilebilecek_yer->images()->save($image);

          return redirect()->route('GezilebilecekYer.showGezilecekyerler',$sehir)->withSuccess('Gezilecek Yer eklendi');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\gezilebilecek_yer  $gezilebilecek_yer
     * @return \Illuminate\Http\Response
     */
    public function show(gezilebilecek_yer $GezilebilecekYer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\gezilebilecek_yer  $gezilebilecek_yer
     * @return \Illuminate\Http\Response
     */
    public function edit(gezilebilecek_yer $GezilebilecekYer)
    {

        $imgs = $GezilebilecekYer->images()->pluck('isim');
        for ($i=0;count($imgs)>$i;$i++)
                $imgs[$i] = url($imgs[$i]);
         $sehir = sehir::where('id',$GezilebilecekYer->sehir_id)->first();

        return view('admin.pages.gezilecek_yer.duzenle')->with('GezilebilecekYer',$GezilebilecekYer)->with('imgs',$imgs)->with('sehir',$sehir);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\gezilebilecek_yer  $gezilebilecek_yer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, gezilebilecek_yer $GezilebilecekYer)
    {

         $this->validate($request,
            ['isim'=> 'required' ,
             'kisaaciklama' => 'required|max:144',
             'uzunaciklama' => 'required',
             'position' => 'required',
             'markerAddress' => 'required',
             'telefon' => 'required|max:17',
             'adres' => 'required',
            'resim' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sehir' => 'required'
            ]
            );

          $GezilebilecekYer->isim = $request->isim;
          $GezilebilecekYer->kisaaciklama = $request->kisaaciklama;
          $GezilebilecekYer->uzunaciklama =  $request->uzunaciklama;
          $GezilebilecekYer->phone = $request->telefon;
          $GezilebilecekYer->adres = $request->adres;
          $GezilebilecekYer->position = $request->position;
          $GezilebilecekYer->markerAddress = $request->markerAddress;

          $images = $GezilebilecekYer->images;

          if($request->file('resim'))
          {

              $resim = $request->file('resim');
              $resim_name = $request->isim.'-'.md5($request->isim.time().'1').'.'.$resim->getClientOriginalExtension();
              $destinationPath = public_path('/gezilecekyer_resimleri/');
              $resim->move($destinationPath, $resim_name);

            if(file_exists($images[0]->isim))
                 unlink($images[0]->isim);

              $images[0]->isim = 'gezilecekyer_resimleri/'.$resim_name;

          }

          $sehir = sehir::find($request->sehir);
          $sehir->gezilebilecek_yers()->save($GezilebilecekYer);
          $GezilebilecekYer->images()->save($images[0]);

          return redirect()->route('GezilebilecekYer.showGezilecekyerler',$sehir)->withSuccess('Gezilecek Yer Düzenlendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\gezilebilecek_yer  $gezilebilecek_yer
     * @return \Illuminate\Http\Response
     */
    public function destroy(gezilebilecek_yer $GezilebilecekYer)
    {

        $images = $GezilebilecekYer->images;
         for($i = 0 ; $i<count($images);$i++)
         {
            if(file_exists($images[$i]->isim))
                unlink($images[$i]->isim);
         }

        $GezilebilecekYer->delete();
        return redirect()->back()->withSuccess('Gezilecek Yer silindi');
    }
}
