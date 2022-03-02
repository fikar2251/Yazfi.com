<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitRumah extends Model
{
    protected $guarded = ['id'];

   public function unit(){
       
       return $this->belongsTo(Spr::class,'id_spr');
   }
}
