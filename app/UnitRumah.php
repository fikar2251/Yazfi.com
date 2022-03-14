<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitRumah extends Model
{
    protected $table = 'unit_rumahs';
    protected $guarded = ['id_unit_rumah']; 
    public $timestamps = false;
 

    public function spr()
    {
        return $this->hasOne(Spr::class, 'id_unit');
    }
   
}
