<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembatalanUnit extends Model
{
    protected $guarded = ['id'];

   public function admin(){
       
       return $this->belongsTo(Users::class,'id_sales');
   }
   public function spr(){
       
       return $this->belongsTo(Users::class,'id_spr');
   }
}
