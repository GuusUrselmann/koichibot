<?php

namespace App\Classes;

use App\Stand;

class Fighter {
    public $type;
    public $stand;
    public $health;
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
        $this->power_min = $power_min;
        $this->power_max = $power_max;
        $this->power = $power;
        $this->speed = $speed;
        $this->range = $range;
        $this->durability = $durability;
        $this->precision = $precision;
        $this->potential = $potential;
        $this->abilities = $abilities;
        $this->level = $level;
    }
}
