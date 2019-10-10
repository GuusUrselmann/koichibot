<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Classes\Fighter;
use App\Classes\Fight;
use App\User;
use App\Stand;
use App\Quest;

class ApiController extends Controller
{
    public function __construct() {
        //$this->middleware('api');
    }

    public function stand(Request $request) {
        $dataPost = $request->all();
        $user = User::with('stand')->where('username', $dataPost['username'])->first();
        if(!$user) {
            return ['response' => 'userEmpty'];
        }
        $data = [
            'user' => $user,
            'response' => 'success'
        ];
        return $data;
    }

    public function setup(Request $request) {
        $dataPost = $request->all();
        $user = User::where('username', $dataPost['username'])->first();
        if($user != null) {
            return ['response' => 'userExists'];
        }
        $stand = Stand::where('type', 'standard')->get()->random();
        $password = Str::random(16);
        $stats = ['E','D','C'];
        $userNew = User::create([
            'discord_id' => $dataPost['discord_id'],
            'username' => $dataPost['username'],
            'password' => Hash::make($password),
            'userlevel'=> 'member',
            'money'=> 0,
            'userskin_id'=> 1,
            'stand_id' => $stand->id,
            'health' => 30,
            'power_min' => 10,
            'power_max' => 20,
            'power' => $stats[array_rand($stats)],
            'speed' => $stats[array_rand($stats)],
            'range' => $stats[array_rand($stats)],
            'durability' => $stats[array_rand($stats)],
            'precision' => $stats[array_rand($stats)],
            'potential' => $stats[array_rand($stats)],
            'level_id' => 1,
            'experience' => 0,
            'unlocks_userskins' => 1
        ]);
        $data = [
            'user' => $userNew,
            'stand' => $stand,
            'password' => $password,
            'response' => 'success'
        ];
        return $data;
    }

    public function profile(Request $request) {
        $dataPost = $request->all();
        $user = User::with('stand', 'userskin')->where('username', $dataPost['username'])->first();
        if(!$user) {
            return ['response' => 'userEmpty'];
        }
        $level = $user->level();
        $levelNext = $user->level(1);
        $data = [
            'user' => $user,
            'level' => $level,
            'levelNext' => $levelNext,
            'response' => 'success'
        ];
        return $data;
    }

    public function quest(Request $request) {
        $dataPost = $request->all();
        //$user = User::with('stand')->where('username', $dataPost['username'])->first();
        $user = User::with('stand')->where('username', $dataPost['username'])->first();
        if(!$user) {
            return ['response' => 'userEmpty'];
        }
        $rarity_boost = $user->getLevelBoost();
        //Get quest
        $quest = Quest::fromRarity($rarity_boost)->inRandomOrder()->first();
        //Get player as fighter (to alter stats if need be)
        $player = new Fighter('player', $user->stand_id, $user->health, $user->power_min, $user->power_max, $user->power, $user->speed, $user->range, $user->durability, $user->precision, $user->potential, $user->abilities, $user->level()->level);
        //Generate enemy as fighter (to alter stats if need be)
        $enemy = $user->generateEnemy($quest->difficulty);
        $fight = new Fight($player, $enemy);
        //$fight->start();
        $data = [
            'user' => $user,
            'quest' => $quest,
            'player' => $player,
            'enemy' => $enemy,
            'response' => 'success'
        ];
        return $data;


        // Level
        // 1-10         5% higher
        // 11-20        10% higher
        // 20-30        20% higher
        // 30-50        35% higher
        // 51-100       50% higher
        // 100+         60% higher

        // Rarity
        // common       800 weight
        // uncommon     500 weight
        // rare         200 weight
        // epic         50 weight
        // legendary    20 weight
        // ascended     5 weight

        // C+U+R+E+L+A  = 1575
        // common       1575 - 800 = 775    50.794%
        // uncommon     1575 - 500 = 1075   31.746%
        // rare         1575 - 200 = 1375   12.698%
        // epic         1575 - 50 = 1525    3.175%
        // legendary    1575 - 20 = 1555    1.270%
        // ascended     1575 - 5 = 1570     0.317%

        // Level 4      5%
        // C+U+R+E+L+A = 1965
        // common       800 + (775 / 100 * 5) = 838.75 = 838    42.646%
        // uncommon     500 + (1075 / 100 * 5) = 553.75 = 553   28.142%
        // rare         200 + (1375 / 100 * 5) = 268.75 = 268   13.639%
        // epic         50 + (1525 / 100 * 5) = 126.25 = 126    6.412%
        // legendary    20 + (1555 / 100 * 5) = 97.75 = 97      4.936%
        // ascended     5 + (1570 / 100 * 5) = 83.5 = 83        4.224%

        // Level 82     60%
        // C+U+R+E+L+A = 6300
        // common       800 + (775 / 100 * 60) = 1265 = 1265    20.079%
        // uncommon     500 + (1075 / 100 * 60) = 1145 = 1145   18.175%
        // rare         200 + (1375 / 100 * 60) = 1025 = 1025   16.270%
        // epic         50 + (1525 / 100 * 60) = 965 = 965      15.317%
        // legendary    20 + (1555 / 100 * 60) = 953 = 953      15.127%
        // ascended     5 + (1570 / 100 * 60) = 947 = 947       15.032%
    }
}
