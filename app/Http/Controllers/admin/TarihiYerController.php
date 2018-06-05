<?php

namespace App\Http\Controllers\admin;

use App\tarihi_yer;
use App\sehir;
use App\image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TarihiYerController extends Controller
{

    public function showTarihiyer(sehir $sehir){

        $tarihi_yerler = $sehir->tarihi_yers()->get();


        return view('admin.pages.tarihi_yer.tarihi_yer')->with('tarihi_yerler',$tarihi_yerler)->with('sehir',$sehir);

    }
    public function createTarihiyer(sehir $sehir){

            return view('admin.pages.tarihi_yer.olustur')->with('sehir',$sehir);
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

          $tarihi_yer = new tarihi_yer;
          $tarihi_yer->isim = $request->isim;
          $tarihi_yer->kisaaciklama = $request->kisaaciklama;
          $tarihi_yer->uzunaciklama =  $request->uzunaciklama;
          $tarihi_yer->phone = $request->telefon;
          $tarihi_yer->adres = $request->adres;
          $tarihi_yer->position = $request->position;
          $tarihi_yer->markerAddress = $request->markerAddress;

          $resim = $request->file('resim');
          $resim_name = $request->isim.'-'.md5($request->isim.time().'1').'.'.$resim->getClientOriginalExtension();
          $destinationPath = public_path('/tarihiyer_resimleri/');
          $resim->move($destinationPath, $resim_name);
          $image = new image;
          $image->isim = 'tarihiyer_resimleri/'.$resim_name;

          $sehir = sehir::find($request->sehir);
          $sehir->tarihi_yers()->save($tarihi_yer);
          $tarihi_yer->images()->save($image);

          return redirect()->route('TarihiYer.showTarihiYerler',$sehir)->withSuccess('Tarihi Yer eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tarihi_yer  $tarihi_yer
     * @return \Illuminate\Http\Response
     */
    public function show(tarihi_yer $tarihi_yer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tarihi_yer  $tarihi_yer
     * @return \Illuminate\Http\Response
     */
    public function edit(tarihi_yer $TarihiYer)
    {
         $imgs = $TarihiYer->images()->pluck('isim');
        for ($i=0;count($imgs)>$i;$i++)
                $imgs[$i] = url($imgs[$i]);
         $sehir = sehir::where('id',$TarihiYer->sehir_id)->first();

        return view('admin.pages.tarihi_yer.duzenle')->with('TarihiYer',$TarihiYer)->with('imgs',$imgs)->with('sehir',$sehir);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tarihi_yer  $tarihi_yer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tarihi_yer $TarihiYer)
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

          $TarihiYer->isim = $request->isim;
          $TarihiYer->kisaaciklama = $request->kisaaciklama;
          $TarihiYer->uzunaciklama =  $request->uzunaciklama;
          $TarihiYer->phone = $request->telefon;
          $TarihiYer->adres = $request->adres;
          $TarihiYer->position = $request->position;
          $TarihiYer->markerAddress = $request->markerAddress;

            $images = $TarihiYer->images;

           if($request->file('resim'))
          {
              $resim = $request->file('resim');
              $resim_name = $request->isim.'-'.md5($request->isim.time().'1').'.'.$resim->getClientOriginalExtension();
              $destinationPath = public_path('/tarihiyer_resimleri/');
              $resim->move($destinationPath, $resim_name);

              if(file_exists($images[0]->isim))
                 unlink($images[0]->isim);

              $images[0]->isim = 'tarihiyer_resimleri/'.$resim_name;
          }



          $sehir = sehir::find($request->sehir);
          $sehir->tarihi_yers()->save($TarihiYer);
          $TarihiYer->images()->save($images[0]);

          return redirect()->route('TarihiYer.showTarihiYerler',$sehir)->withSuccess('Tarihi Yer düzenlendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tarihi_yer  $tarihi_yer
     * @return \Illuminate\Http\Response
     */
    public function destroy(tarihi_yer $TarihiYer)
    {

          $images = $TarihiYer->images;
         for($i = 0 ; $i<count($images);$i++)
         {
            if(file_exists($images[$i]->isim))
                unlink($images[$i]->isim);
         }
        $TarihiYer->delete();
        return redirect()->back()->withSuccess('Tarihi Yer silindi');
    }
}
