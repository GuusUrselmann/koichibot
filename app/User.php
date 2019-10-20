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
        'discord_id', 'username', 'password', 'userlevel', 'money', 'userskin_id', 'stand_id', 'health', 'power_min', 'power_max', 'power', 'speed', 'range', 'durability', 'precision', 'potential', 'level_id', 'experience', 'unlocks_userskins', 'inventory_artifacts', 'inventory_arrows'
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
        if(!Level::where('level', $level->level+$add)->first()) {
            return $level;
        }
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
        $abilities = '';
        $level = $this->level()->level;

        $enemy = new Fighter('enemy', $stand_id, $health, $power_min, $power_max, $power, $speed, $range, $durability, $precision, $potential, $abilities, $level);
        return $enemy;

        /* TODO:
        * Enemy based off of level, check meta for calculations
        */
    }

    public function reward($rewards) {
        if(!empty($rewards['money'])) {
            $this->money_add($rewards['money']['amount']);
        }
        if(!empty($rewards['experience'])) {
            $this->experience_add($rewards['experience']['amount']);
        }
        if(!empty($rewards['artifact'])) {
            $this->artifact_add($rewards['artifact']['item']);
        }
        if(!empty($rewards['arrow'])) {
            $this->arrow_add($rewards['arrow']['item']);
        }
    }

    public function money_add($amount) {
        $this->update([
            'money' => $this->money+$amount
        ]);
    }

    public function experience_add($amount) {
        //TODO: Make sure it works for massive exp boosts (with a loop)
        //TODO: Make a level up response checker
        if(!$this->level(1)) {
            return;
        }
        if(($amount+$this->experience) > $this->level(1)->experience) {
            $this->update([
                'level_id' => $this->level(1)->level,
                'experience' => $amount+$this->experience-$this->level(1)->experience
            ]);
        }
        else {
            $this->update([
                'experience' => $amount+$this->experience
            ]);
        }
    }

    public function artifact_add($artifact) {
        //TODO: make an achievement checker and run it here
        $inventory = [];
        $inventory_artifacts = explode(',', $this->inventory_artifacts);
        foreach($inventory_artifacts as $inventory_artifact) {
            $inventory[] = explode(':', $inventory_artifact);
        }
        foreach($inventory as $i => $item) {
            if($item[0] == $artifact->id) {
                //already exists, add 1 to inv
                $inventory[$i][1] += 1;
                $inv_string = '';
                foreach($inventory as $inventory_item) {
                    $inv_string .= $inventory_item[0].':'.$inventory_item[1].',';
                }
                $inv_string = substr($inv_string, 0, -1);
                $this->update([
                    'inventory_artifacts' => $inv_string
                ]);
                //check for achievements
                // $this->achievements_check();
                return;
            }
        }
        //Add new to inventory
        $inventory[] = [$artifact->id,1];
        $inv_string = '';
        foreach($inventory as $inventory_item) {
            $inv_string .= $inventory_item[0].':'.$inventory_item[1].',';
        }
        $inv_string = substr($inv_string, 0, -1);
        $this->update([
            'inventory_artifacts' => $inv_string
        ]);
        //check for achievements
        // $this->achievements_check();
    }

    public function arrow_add($arrow) {
        $inventory = [];
        $inventory_arrows = explode(',', $this->inventory_arrows);
        foreach($inventory_arrows as $inventory_arrow) {
            $inventory[] = explode(':', $inventory_arrow);
        }
        foreach($inventory as $i => $inv_arrow) {
            if($inv_arrow[0] == $arrow) {
                //Already exists, add 1 to inventory
                $inventory[$i][1] += 1;
                $inv_string = '';
                foreach($inventory as $inventory_item) {
                    $inv_string .= $inventory_item[0].':'.$inventory_item[1].',';
                }
                $inv_string = substr($inv_string, 0, -1);
                $this->update([
                    'inventory_arrows' => $inv_string
                ]);
                //Check for achievements??
                return;
            }

        }
        //Add new to inventory
        $inventory[] = [$arrow,1];
        $inv_string = '';
        foreach($inventory as $inventory_item) {
            $inv_string .= $inventory_item[0].':'.$inventory_item[1].',';
        }
        $inv_string = substr($inv_string,0,-1);
        $this->update([
            'inventory_arrows' => $inv_string
        ]);
        //Check for achievements??
    }

    public function arrow_has($arrow) {
        $inventory = [];
        $inventory_arrows = explode(',', $this->inventory_arrows);
        foreach($inventory_arrows as $inventory_arrow) {
            $inventory[] = explode(':', $inventory_arrow);
        }
        foreach($inventory as $i => $inv_arrow) {
            if($inv_arrow[0] == $arrow) {
                if($inv_arrow[1] > 0) {
                    return true;
                }
            }
            return false;
        }
    }

    public function arrow_remove($arrow) {
        $inventory = [];
        $inventory_arrows = explode(',', $this->inventory_arrows);
        foreach($inventory_arrows as $inventory_arrow) {
            $inventory[] = explode(':', $inventory_arrow);
        }
        foreach($inventory as $i => $inv_arrow) {
            if($inv_arrow[0] == $arrow) {
                $inventory[$i][1] = $inventory[$i][1] - 1;
            }
        }
        $inv_string = '';
        foreach($inventory as $inventory_item) {
            $inv_string .= $inventory_item[0].':'.$inventory_item[1].',';
        }
        $inv_string = substr($inv_string,0,-1);
        $this->update([
            'inventory_arrows' => $inv_string
        ]);
    }
}
