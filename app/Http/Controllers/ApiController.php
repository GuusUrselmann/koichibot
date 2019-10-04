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
        $dataPost = $request->all();
        $user = User::with('stand')->where('username', $dataPost['username'])->first();
        if(!$user) {
            return ['response' => 'emptyUser'];
        }
        $data = [
            'user' => $user,
            'response' => 'success'
        ];
        return $data;
    }

    public function quest() {

    }

    public function search() {

    }
}
