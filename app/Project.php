<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = ['id_project'];
    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
    public function inout()
    {
        return $this->hasMany(InOut::class);
    }
    public function purchase()
    {
        return $this->hasMany(Purchase::class);
    }
}
