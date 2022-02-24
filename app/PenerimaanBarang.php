<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class PenerimaanBarang extends Model
{

    use HasRoles;
    protected $guarded = ['id'];
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
        return $this->belongsTo(Role::class, 'id_roles');
    }
}
