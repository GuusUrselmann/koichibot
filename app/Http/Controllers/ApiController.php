<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use App\Stand;

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
        $stats = ['E','D','C']
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
        //TODO: change STATS to grab value instead of index
        $data = [
            'user' => $userNew,
            'stand' => $stand,
            'password' => $password,
            'response' => 'success'
        ];
        return $data;
    }
}
