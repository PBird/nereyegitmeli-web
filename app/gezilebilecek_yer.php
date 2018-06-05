<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gezilebilecek_yer extends Model
{

     protected $fillable = [
        'isim', 'kisaaciklama', 'uzunaciklama','adres','telefon','position','markerAddress'
    ];
     public function images()
    {
        return $this->morphMany('App\image', 'imageable');
    }

    public static function boot() {
        parent::boot();


        self::deleting(function ($value) {
            $images = $value->images;
             for($i = 0 ; $i<count($images);$i++)
             {
                if(file_exists($images[$i]->isim))
                    unlink($images[$i]->isim);
             }
        });
    }
}
