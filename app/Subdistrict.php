<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    protected $table = 'subdistricts';
    protected $guarded = [];
    protected $primaryKey = 'subdis_id';

    public function alamat ()
    {
        return $this->hasMany(Alamat::class, 'desa_id');
    }
}
