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
    public static function balance($fight) {

    }

    // steel shield ability
    public static function steel_shield($fight) {

    }
}
