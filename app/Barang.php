<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $guarded = ['id'];

    public function hargaproduk()
    {
        return $this->belongsTo(HargaProdukCabang::class, 'barang_id');
    }

    public function tindakan()
    {
        return $this->hasMany(Tindakan::class);
    }

    public function produkharga()
    {
        return $this->hasMany(HargaProdukCabang::class);
    }

    public function purchase()
    {
        return $this->hasMany(Purchase::class);
    }

    public function inout()
    {
        return $this->hasMany(InOut::class);
    }
}
