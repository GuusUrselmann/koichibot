<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AbilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ability::create([
            'name' => 'Timestop',
            'description' => 'Use your ability to stop time and hit 30% of your normal damage to the enemy multiple times in a row!',
            'type' => 'active'
        ]);
        App\Ability::create([
            'name' => 'Megabeam',
            'description' => 'Prepare a laser for 1 turn to then fire a large attack onto the enemy',
            'type' => 'active'
        ]);
        App\Ability::create([
            'name' => 'Balance',
            'description' => 'Calm yourself for a moment to regain energy and heal yourself',
            'type' => 'active'
        ]);
        App\Ability::create([
            'name' => 'Steel shield',
            'description' => 'You take half as much damage for the entire fight',
            'type' => 'passive'
        ]);
    }
}
