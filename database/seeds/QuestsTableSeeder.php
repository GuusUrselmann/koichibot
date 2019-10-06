<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QuestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Quest::create([
            'name' => 'Market robbery',
            'description' => 'You make your way down the market as you see a robbery, you decide to make a stop to it to maybe earn a little extra cash.',
            'description_win' => 'Success! You\'ve put an end to this and stopped the thieves before they had a chance at doing any damage.',
            'description_lose' => 'you failed miserable in stopping the thieves and as soon as you woke up after the fight, they were already gone.',
            'money_spread' => 200,
            'experience_spread' => 15,
            'rarity' => 'uncommon',
            'rarity_loot' => 'common'
        ]);
        App\Quest::create([
            'name' => 'Tough guys',
            'description' => 'On an early afternoon you walk around on the streets, making your way downtown as you then suddenly get pulled into an alleyway, you see someone holding a knife in front of you as they threaten you for your money.',
            'description_win' => 'You defeated the mugger and grabbed any gold her had on him before walking away and going on about your day.',
            'description_lose' => 'The mugger defeated you and stole some of your money before he ran away deeper into the maze of alleyways, accepting your defeat, you decided to quickly make it out of there',
            'money_spread' => 700,
            'experience_spread' => 15,
            'rarity' => 'rare',
            'rarity_loot' => 'uncommon'
        ]);
    }
}
