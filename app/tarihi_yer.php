<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tarihi_yer extends Model
{

   protected $fillable = [
        'isim', 'kisaaciklama', 'uzunaciklama','adres','telefon','position','markerAddress'
    ];
       public function images()
    {
        return $this->morphMany('App\image', 'imageable');
    }

}
