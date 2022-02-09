<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
    public function inout()
    {
        return $this->hasMany(InOut::class);
    }
}
