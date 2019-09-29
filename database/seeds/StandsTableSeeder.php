<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Stand::create([
            'name' => 'Star Platinum',
            'lore' => 'Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet',
            'image' => 'stands/StarPlatinum.png'
        ]);
        App\Stand::create([
            'name' => 'Killer Queen',
            'lore' => 'Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet',
            'image' => 'stands/KillerQueen.png'
        ]);
        App\Stand::create([
            'name' => 'King Crimson',
            'lore' => 'Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet',
            'image' => 'stands/KingCrimson.png'
        ]);
        App\Stand::create([
            'name' => 'Dog\'s Stand',
            'lore' => 'Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet',
            'image' => 'stands/DogsStand.png'
        ]);
        App\Stand::create([
            'name' => 'Waste Of Nut',
            'lore' => 'Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet',
            'image' => 'stands/WasteOfNut.png'
        ]);
        App\Stand::create([
            'name' => 'White Album',
            'lore' => 'Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet',
            'image' => 'stands/WhiteAlbum.png'
        ]);
        App\Stand::create([
            'name' => 'Golden Experience',
            'lore' => 'Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet',
            'image' => 'stands/GoldenExperience.png'
        ]);
        App\Stand::create([
            'name' => 'The Hand',
            'lore' => 'Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet',
            'image' => 'stands/TheHand.png'
        ]);
        App\Stand::create([
            'name' => 'Star Platinum The World Over Heaven',
            'lore' => 'Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet',
            'image' => 'stands/StarPlatinumTheWorldOverHeaven.png'
        ]);
        App\Stand::create([
            'name' => 'King Crimson Requiem',
            'lore' => 'Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet',
            'image' => 'stands/KingCrimsonRequiem.png'
        ]);
        App\Stand::create([
            'name' => 'Hermit Purple',
            'lore' => 'Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet',
            'image' => 'stands/HermitPurple.png'
        ]);
        App\Stand::create([
            'name' => 'Hierophant Green',
            'lore' => 'Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet',
            'image' => 'stands/HierophantGreen.png'
        ]);
        App\Stand::create([
            'name' => 'Silver Chariot',
            'lore' => 'Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet Lorum ipsum dolor sit amet',
            'image' => 'stands/SilverChariot.png'
        ]);
    }
}
