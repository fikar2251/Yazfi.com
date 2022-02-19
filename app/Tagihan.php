<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'rincian_tagihan_spr';
    protected $guarded = ['jatuh_tempo'];
    public $timestamps = false;
}
