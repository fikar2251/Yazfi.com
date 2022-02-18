<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RincianPengajuan extends Model
{
    protected $guarded = ['id'];
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'id');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id');
    }
}
