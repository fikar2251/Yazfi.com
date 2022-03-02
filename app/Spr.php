<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spr extends Model
{
   
    protected $guarded = [];
    public function unit(){
       
        return $this->belongsTo(UnitRumah::class,'id_unit');
    }
}
