<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Classes\Fighter;
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
        return $this->belongsTo(Stand::class);
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

    public function getLevelBoost() {
        $level_weights = [
            '0' => 0,
            '10' => 5,
            '20' => 10,
            '30' => 20,
            '50' => 35,
            '100' => 50,
            '200' => 60
        ];
        $boost = 00;
        foreach($level_weights as $weight_level => $weight) {
            if($this->level()->level > (int)$weight_level) {
                $boost = $weight;
            }
            else {
                break;
            }
        }
        return $boost;
    }

    public function generateEnemy($difficulty) {
        $difficulties = [
            'easy' => 10,
            'moderate' => 30,
            'hard' => 60,
            'expert' => 80
        ];
        $statvalues = ['E','D','C','B','A'];
        $health_min = ceil($this->health / 10 * 7);
        $health_max = ceil($this->health / 10 * 15);

        $stand_id = Stand::where('type', 'standard')->get()->random()->id;
        $health = rand($health_min, $health_max);
        $power_min = rand($this->power_min / 10 * 7, $this->power_min / 10 * rand(7,14));
        $power_max = rand($power_min / 10 * 12, $this->power_max / 10 * rand(12,18));
        $power = $statvalues[rand(0,4)];
        $speed = $statvalues[rand(0,4)];
        $range = $statvalues[rand(0,4)];
        $durability = $statvalues[rand(0,4)];
        $precision = $statvalues[rand(0,4)];
        $potential = $statvalues[rand(0,4)];
        $abilities = [];
        $level = $this->level()->level;

        $enemy = new Fighter('enemy', $stand_id, $health, $power_min, $power_max, $power, $speed, $range, $durability, $precision, $potential, $abilities, $level);
        return $enemy;
    }
}
