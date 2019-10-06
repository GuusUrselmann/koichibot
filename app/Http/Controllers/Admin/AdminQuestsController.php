<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Quest;

class AdminQuestsController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function quests() {
        $quests = Quest::all();
        (array) $quests;

        return view('admin/quests/quests', compact('quests'));
    }
}
