<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Level::create([
            'level' => 1,
            'experience' => 0
        ]);
        App\Level::create([
            'level' => 2,
            'experience' => 50
        ]);
        App\Level::create([
            'level' => 3,
            'experience' => 100
        ]);
        App\Level::create([
            'level' => 4,
            'experience' => 200
        ]);
        App\Level::create([
            'level' => 5,
            'experience' => 500
        ]);
        App\Level::create([
            'level' => 6,
            'experience' => 1000
        ]);
    }
}
