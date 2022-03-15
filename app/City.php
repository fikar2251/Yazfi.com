<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $guarded = [];
    protected $primaryKey = 'city_id';

    public function alamat()
    {
        return $this->hasMany(Alamat::class, 'kota_id');
    }
}
