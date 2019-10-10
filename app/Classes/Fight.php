<?php

namespace App\Classes;

use App\Ability;

class Fight {
    public $fighters = [];
    public $turn;
    public $fighter_current;
    public $log;
    public $winner = false;
    public $winner_fighter;


    public function __construct($player, $enemy) {
        $this->fighters = [$player, $enemy];
        $this->fighters[0]->health = 20;
    }

    public function start() {
        //only able to access $fighter_current after setup
        $this->setup();
        $this->fight();
    }

    private function setup() {
        //Alter fight for each player
        foreach($this->fighters as $i => $fighter) {
            $this->fighters[$i]->instance_id = $i;
            $this->fighter_current = $this->fighters[$i];
            if(!$fighter->abilities) {
            }
            else {
                foreach($fighter->abilities as $ability) {
                    if($ability->type == 'passive') {
                        $this->useAbility($ability->name);
                    }
                }
            }
        }
        $this->fighter_current = $this->fighters[0];
        //TODO: decide start user here
    }

    private function fight() {
        // While loop for turns until someone wins
        while(!$this->winner) {
            // Check current field conditions
            // Check abilities
            $this->playTurn();
            // End turn
            if($this->getNextFighter()->health <= 0) {
                $this->winner_fighter = $this->fighter_current;
                $this->winner = true;
                break;
            }
            $this->nextFighter();

            // $this->winner_fighter = $this->fighter_current;
            // $this->winner = true;
        }
    }

    private function playTurn() {
        $ability_used = false;
        if(!$this->fighter_current->abilities) {
        }
        else {
            foreach($this->fighter_current->abilities as $ability) {
                if($ability->type == 'active') {
                    $used = $this->useAbility($ability->name);
                    if($used) {
                        $ability_user = true;
                        break;
                    }
                }
            }

        }
        if(!$ability_used) {
            $target = $this->getNextFighter();
            $this->attack($target);
        }
    }

    private function useAbility($ability_name) {
        $ability = Ability::use($this, str_slug($ability_name, '_'));
        return $ability;
    }
    private function getNextFighter() {
        if(!isset($this->fighters[$this->fighter_current->instance_id+1])) {
            return $this->fighters[0];
        }
        return $this->fighters[$this->fighter_current->instance_id+1];
    }
    private function nextFighter() {
        if(!isset($this->fighters[$this->fighter_current->instance_id+1])) {
            $this->fighter_current = $this->fighters[0];
            return;
        }
        $this->fighter_current = $this->fighters[$this->fighter_current->instance_id+1];
        return;
    }

    public function attack($target) {
        $damage = rand($this->fighter_current->power_min, $this->fighter_current->power_max);
        $target = $this->getNextFighter();
        $this->log('**[**'.$this->fighter_current->type.' '.$this->fighter_current->health.'**/**'.$this->fighter_current->health_max.'**]** attacked **'.$target->type.'** for **'.$damage.'** damage **[**'.$target->type.' '.$target->health.'**/**'.$target->health_max.'**]**');
        $target->health -= $damage;
    }

    public function log($string) {
        $this->log .= "$string\n";
    }
}
