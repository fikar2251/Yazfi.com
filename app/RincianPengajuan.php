<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RincianPengajuan extends Model
{
    protected $guarded = ['id'];
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'id');
    }
}
