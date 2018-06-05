<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sehir extends Model
{

    protected $fillable = ['isim','aciklama','position','markerAddress'];
     public function gezilebilecek_yers()
    {
        return $this->hasMany('App\gezilebilecek_yer');
    }
     public function otels()
    {
        return $this->hasMany('App\otel');
    }
     public function restorans()
    {
        return $this->hasMany('App\restoran');
    }
     public function tarihi_yers()
    {
        return $this->hasMany('App\tarihi_yer');
    }

    // for images
       public function images()
    {
        return $this->morphMany('App\image', 'imageable');
    }


}
