<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Job::create([
            'description' => 'Your uncle runs an apple garden, you decide to help with his harvest and gained a little extra money.',
            'money_spread' => 150,
            'rarity' => 'common'
        ]);
        App\Job::create([
            'description' => 'Your uncle runs an apple garden, you decide to help with his harvest and gained a little extra money.',
            'money_spread' => 150,
            'rarity' => 'uncommon'
        ]);
        App\Job::create([
            'description' => 'Your uncle runs an apple garden, you decide to help with his harvest and gained a little extra money.',
            'money_spread' => 150,
            'rarity' => 'rare'
        ]);
        App\Job::create([
            'description' => 'Your uncle runs an apple garden, you decide to help with his harvest and gained a little extra money.',
            'money_spread' => 150,
            'rarity' => 'epic'
        ]);
        App\Job::create([
            'description' => 'Your uncle runs an apple garden, you decide to help with his harvest and gained a little extra money.',
            'money_spread' => 150,
            'rarity' => 'legendary'
        ]);
        App\Job::create([
            'description' => 'Your uncle runs an apple garden, you decide to help with his harvest and gained a little extra money.',
            'money_spread' => 150,
            'rarity' => 'ascended'
        ]);
    }
}
