<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spr extends Model
{
    protected $table = 'sprs';
    protected $guarded = ['id'];

    public function unit()
    {
        return $this->belongsTo(UnitRumah::class, 'id_unit');
    }
    public function pembatalan()
    {
        return $this->hasOne(PembatalanUnit::class, 'spr_id');
    }

}
