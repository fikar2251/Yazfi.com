<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $guarded = [];
    protected $primaryKey = 'dis_id';

    public function alamat()
    {
        return $this->hasMany(Alamat::class, 'kecamatan_id');
    }
}
