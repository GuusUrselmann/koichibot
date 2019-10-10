<?php

namespace App\Classes;

use App\Stand;

class Fight {
    public $player;
    public $enemy;


    public function __construct($player, $enemy) {
        $this->player = $player;
        $this->enemy = $enemy;
    }
}
