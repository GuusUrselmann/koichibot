<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SearchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Search::create([
            'description' => 'You look around your room hoping to find something valuable.',
            'money_spread' => 150,
            'rarity' => 'common'
        ]);
        App\Search::create([
            'description' => 'You look around your room hoping to find something valuable.',
            'money_spread' => 150,
            'rarity' => 'uncommon'
        ]);
        App\Search::create([
            'description' => 'You look around your room hoping to find something valuable.',
            'money_spread' => 150,
            'rarity' => 'rare'
        ]);
        App\Search::create([
            'description' => 'You look around your room hoping to find something valuable.',
            'money_spread' => 150,
            'rarity' => 'epic'
        ]);
        App\Search::create([
            'description' => 'You look around your room hoping to find something valuable.',
            'money_spread' => 150,
            'rarity' => 'legendary'
        ]);
        App\Search::create([
            'description' => 'You look around your room hoping to find something valuable.',
            'money_spread' => 150,
            'rarity' => 'ascended'
        ]);
    }
}
