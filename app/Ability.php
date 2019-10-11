<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    public static function use($fight, $ability_name) {
        self::$ability_name($fight);
    }

    // timestop ability
    public static function timestop($fight) {

    }

    // megabeam ability
    public static function megabeam($fight) {

    }

    // balance ability
    // When health is lower than 50%, have a 30% chance to heal 20% of your total health
    public static function balance($fight) {
        //conditions
        // if(!$fight->fighter_current->health < ceil($fight->fighter_current->health_max / 10 * 5)) {
        //     return false;
        // }
        $chance = 30;
        $rng = rand(0, 100);
        if($rng > $chance) {
            return false;
        }
        $amount = $fight->fighter_current->health_max / 10 * 2;
        // Heal fighter
        $fight->fighter_current->health += $amount + $fight->fighter_current->health <= $fight->fighter_current->health ? $fight->current_fighter->health_max + $heal : $fight->fighter_current->health = $fight->fighter_current->health_max;
        $fight->log('**[**'.$fight->fighter_current->type.' '.$fight->fighter_current->health.'**/**'.$fight->fighter_current->health_max.'**]** used ability **Balance**');
        $fight->log('**[**'.$fight->fighter_current->type.' '.$fight->fighter_current->health.'**/**'.$fight->fighter_current->health_max.'**]** healed for **$amount**');
        return true;
    }

    // steel shield ability
    public static function steel_shield($fight) {

    }
}
