<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Stand;
use App\Userskin;
use App\Level;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'discord_id', 'password', 'stand_id', 'power_min', 'power_max', 'health', 'speed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function stand() {
        return Stand::find($this->stand_id);
    }

    public function userskin() {
        return Userskin::find($this->userskin_id);
    }

    public function level() {
        return Level::find($this->level_id);
    }
}
