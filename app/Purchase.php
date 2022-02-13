<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
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
}
