<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Stand;
use App\Userskin;
use App\Level;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'discord_id', 'username', 'password', 'userlevel', 'money', 'userskin_id', 'stand_id', 'health', 'power_min', 'power_max', 'power', 'speed', 'range', 'durability', 'precision', 'potential', 'level_id', 'experience', 'unlocks_userskins'
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
        return $this->belongsTo(Stand::class, $this->stand_id+1);
    }

    public function userskin() {
        return $this->belongsTo(Userskin::class);
    }

    public function level($add = 0) {
        $level = Level::where('level', $this->level_id)->first();
        return Level::where('level', $level->level + $add)->first();
    }

    public function unlockedUserskin($id) {
        $unlocks = explode(',', $this->unlocks_userskins);
        if(in_array($id, $unlocks)) {
            return true;
        }
        return false;
    }
}
