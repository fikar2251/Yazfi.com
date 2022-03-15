<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    protected $table = 'provinces';
    protected $guarded = [];
    protected $primaryKey = 'prov_id';

    public function alamat()
    {
        return $this->hasMany(Alamat::class, 'provinsi_id');
    }
}
