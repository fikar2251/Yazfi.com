<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class Pengajuan extends Model
{
    protected $guarded = ['id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id');
    }
    public function rincianpengajuan()
    {
        return $this->belongsTo(RincianPengajuan::class, 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function roles()
    {
        return $this->belongsTo(Roles::class, 'id_roles');
    }
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatans');
    }
}
