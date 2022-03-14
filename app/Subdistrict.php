<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    protected $table = 'subdistricts';
    protected $guarded = [];
    protected $primaryKey = 'subdis_id';
}
