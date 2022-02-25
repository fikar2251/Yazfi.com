<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembatalan extends Model
{
    protected $table = 'pembatalan_unit';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function spr()
    {
        return $this->belongsTo(Spr::class, 'spr_id');
    }
}
