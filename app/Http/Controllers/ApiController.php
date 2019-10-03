<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ApiController extends Controller
{
    public function __construct() {
        //$this->middleware('api');
    }

    //Job command
    public function stand(Request $request) {
        return $request->input('username');
        $user = User::find(2);
        return $user;
        // $damage1 = rand($user->power_min, $user->power_max);
        // echo $user->power_min.'/'.$user->power_max.'<br/>';
        // echo $damage1.'<br/>';
        // $power_alt = statToPercent($user->power);
        // echo $power_alt.'<br/>';
        // $d = ($user->power_max - $user->power_min) * ($power_alt);
        // $damage2 = rand(($user->power_min+$d), $user->power_max);
        // echo $damage2;
    }

    public function quest() {

    }

    public function search() {

    }
}
