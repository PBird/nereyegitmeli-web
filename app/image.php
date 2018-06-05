<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{

    protected $fillable = ['isim'];
     public function imageable()
    {
        return $this->morphTo();
    }
}
