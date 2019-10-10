<?php

namespace App\Classes;

use App\Stand;
use App\Ability;

class Fighter {
    public $instance_id;
    public $type;
    public $stand;
    public $health;
    public $health_max;
    public $power_min;
    public $power_max;
    public $power;
    public $speed;
    public $range;
    public $durability;
    public $precision;
    public $potential;
    public $abilities;
    public $level;

    public function __construct($type, $stand_id, $health, $power_min, $power_max, $power, $speed, $range, $durability, $precision, $potential, $abilities, $level) {
        $this->type = $type;
        $this->stand = Stand::find($stand_id);
        $this->health = $health;
        $this->health_max = $health;
        $this->power_min = $power_min;
        $this->power_max = $power_max;
        $this->power = $power;
        $this->speed = $speed;
        $this->range = $range;
        $this->durability = $durability;
        $this->precision = $precision;
        $this->potential = $potential;
        $this->abilities = $this->getAbilities($abilities);
        $this->level = $level;
    }

    public function getAbilities($ability_ids) {
        $abilities = [];
        if($ability_ids == '') {
            return [];
        }
        $ability_ids = explode(',', $ability_ids);
        foreach($ability_ids as $id) {
            $ability = Ability::find($id);
            $abilities[$id] = $ability;
        }
        return $abilities;
    }
}
