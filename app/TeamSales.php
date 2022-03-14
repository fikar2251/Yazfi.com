<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class TeamSales extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guarded = ['id'];
    protected $table = 'team_sales';

 

    public function admin()
    {
        return $this->belongsTo(User::class,'id_sales');
    }

    public function manager()
    {
        return $this->belongsTo(User::class,'id_manager');
    }
    public function spv()
    {
        return $this->belongsTo(User::class,'id_spv');
    }

}
