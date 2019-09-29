<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Stand extends Model
{
    public function active() {
        return $this->hasMany(User::class)->count();
    }
}
