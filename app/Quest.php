<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    public function scopeFromRarity($query, $weight_boost = 0) {
        $weights = [
            'common' => 800,
            'uncommon' => 500,
            'rare' => 200,
            'epic' => 50,
            'legendary' => 20,
            'ascended' => 5
        ];

        $rarity = '';
        $loop = true;
        while($loop) {
            $result = getRarity($weights);
            $quest = Quest::where('rarity', $result)->first();
            if(!$quest) {
                return;
            }
            $rarity = $result;
            $loop = false;
        }

        return $query->where('rarity', $rarity);
    }
}
