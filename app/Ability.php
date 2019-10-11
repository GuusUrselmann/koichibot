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
        $chance = 30;
        $rng = rand(0,100);
        if($chance >= $rng) {
            return;
        }
        $fight->log("**[**'.$fight->fighter_current->type.' '.$fight->fighter_current->health.'**/**'.$fight->fighter_current->health_max.'**]** used ability **TIMESTOP**");
        $target = $this->getNextFighter();
        $fight->attack($target);
        $fight->attack($target);
        $fight->attack($target);
    }

    // megabeam ability
    public static function megabeam($fight) {

    }

    // balance ability
    public static function balance($fight) {

    }

    // steel shield ability
    public static function steel_shield($fight) {

    }
}
