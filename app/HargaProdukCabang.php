<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HargaProdukCabang extends Model
{
    protected $guarded = ['id'];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    public function product()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
