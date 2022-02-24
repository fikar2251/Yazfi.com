<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RincianReinburst extends Model
{
    protected $guarded = ['id'];
    public function reinburst()
    {
        return $this->belongsTo(Reinburst::class, 'nomor_reinburst');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
