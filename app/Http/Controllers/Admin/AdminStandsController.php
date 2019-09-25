<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Stand;

class AdminStandsController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function stands() {
        $stands = Stand::all();
        (array) $stands;

        return view('admin/stands/stands', compact('stands'));
    }
}
