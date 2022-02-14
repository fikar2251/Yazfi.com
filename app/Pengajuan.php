<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class Pengajuan extends Model
{
    protected $guarded = ['id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class,'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class,'id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function roles()
    {
        return $this->belongsTo(Roles::class);
    }
}
