<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Komisi extends Model
{
    protected $guarded = ['id'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
