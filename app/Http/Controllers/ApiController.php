<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;

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
            return ['response' => 'userExist'];
        }
        $password = Str::random(16);
        $standIds = Stand::where('type', 'standard')->pluck('id')
        $standIdKey = array_rand($standIds);
        // User::create([
        //     'discord_id' => $dataPost['discord_id'],
        //     'username' => $dataPost['username'],
        //     'password' => Hash::make($password),
        //     'userlevel'=> 'member',
        //     'money'=> 0,
        //     'userskin_id'=> 1,
        //     'stand_id' => $standIds[$standIdKey],
        //     'health' => 30,
        //     'power_min' => 10,
        //     'power_max' => 20,
        //     'power' => array_rand(['E','D','C']),
        //     'speed' => array_rand(['E','D','C']),
        //     'range' => array_rand(['E','D','C']),
        //     'durability' => array_rand(['E','D','C']),
        //     'precision' => array_rand(['E','D','C']),
        //     'potential' => array_rand(['E','D','C']),
        //     'level_id' => 1,
        //     'experience' => 0,
        //     'unlocks_userskins' => 1
        // ]);
        User::create([
            'discord_id' => 17425,
            'username' => 'messenwerper#9989',
            'password' => Hash::make('$password'),
            'userlevel'=> 'member',
            'money'=> 0,
            'userskin_id'=> 1,
            'stand_id' => 1,
            'health' => 30,
            'power_min' => 10,
            'power_max' => 20,
            'power' => array_rand(['E','D','C']),
            'speed' => array_rand(['E','D','C']),
            'range' => array_rand(['E','D','C']),
            'durability' => array_rand(['E','D','C']),
            'precision' => array_rand(['E','D','C']),
            'potential' => array_rand(['E','D','C']),
            'level_id' => 1,
            'experience' => 0,
            'unlocks_userskins' => 1
        ]);
        $userNew = User::with('stand')->where('username', $dataPost['username'])->first();
        $data = [
            'user' => '$userNew',
            'password' => '$password',
            'response' => 'success'
        ];
        return $data;
    }
}
