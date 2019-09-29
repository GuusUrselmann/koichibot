<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Level;

class AdminLevelsController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function levels() {
        $levels = Level::all();
        (array) $levels;

        return view('admin/levels/levels', compact('levels'));
    }
}
