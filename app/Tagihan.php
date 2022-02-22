<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'rincian_tagihan_spr';
    protected $guarded = ['jatuh_tempo'];
    protected $primaryKey = 'id_rincian';
    public $timestamps = false;

    public function spr()
    {
        return $this->belongsTo(Spr::class, 'id_spr');
    }
}
