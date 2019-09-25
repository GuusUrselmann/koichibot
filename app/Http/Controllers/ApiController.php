<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function __construct() {
        //$this->middleware('api');
    }

    //Job command
    public function job() {
        return "hello";
    }
}
