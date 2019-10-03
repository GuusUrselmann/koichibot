<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Stand extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function active() {
        return $this->hasMany(User::class)->count();
    }
}
