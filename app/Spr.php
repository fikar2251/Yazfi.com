<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spr extends Model
{
    protected $table = 'spr';
    protected $guarded = [];
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;
}
