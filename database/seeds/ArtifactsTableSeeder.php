<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ArtifactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Artifact::create([
            'name' => 'Jotaro\'s Hat',
            'description' => 'The iconic hat Jotaro Kujo wears during his adventures.',
            'price_sell' => 2500,
            'image' => 'artifacts/JotarosHat.jpg',
            'rarity' => 'common'
        ]);
        App\Artifact::create([
            'name' => 'Bow and Arrow',
            'description' => 'Recovered from a mysterious meteor, nobody knows the potential of this artifact.',
            'price_sell' => 3000,
            'image' => 'artifacts/BowAndArrow.png',
            'rarity' => 'uncommon'
        ]);
        App\Artifact::create([
            'name' => 'Steel Ball',
            'description' => 'This is a steel ball.',
            'price_sell' => 5000,
            'image' => 'artifacts/SteelBall.png',
            'rarity' => 'rare'
        ]);
        App\Artifact::create([
            'name' => 'Dio\'s Bone',
            'description' => 'Apparently, Dio lost his bone and you found it.',
            'price_sell' => 6500,
            'image' => 'artifacts/DiosBone.jpg',
            'rarity' => 'epic'
        ]);
        App\Artifact::create([
            'name' => 'Wedding Ring of Death',
            'description' => 'Who knows what\'ll happen when wearing this.',
            'price_sell' => 8000,
            'image' => 'artifacts/WeddingRingOfDeath.png',
            'rarity' => 'legendary'
        ]);
        App\Artifact::create([
            'name' => 'Stone Mask',
            'description' => 'It smells like someone\'s face.',
            'price_sell' => 10000,
            'image' => 'artifacts/StoneMask.png',
            'rarity' => 'ascended'
        ]);
    }
}
