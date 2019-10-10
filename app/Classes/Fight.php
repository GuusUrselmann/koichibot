<?php

namespace App\Classes;

use App\Stand;

class Fight {
    public $fighters = [];


    public function __construct($player, $enemy) {
        $this->player = $player;
        $this->enemy = $enemy;
        $this->fighters = [$player, $enemy];
    }

    public function start() {
        $this->setup();
    }

    private function setup() {
        foreach($fighters as $fighter) {
            dd($fighter);
        }
    }

    private function attack($target) {

    }
}
