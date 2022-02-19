<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    protected $table = 'skema_pembayaran';
    protected $guarded = [];
    public $timestamps =  false;
}
