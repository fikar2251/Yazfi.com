<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $table = 'refund';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;
}
