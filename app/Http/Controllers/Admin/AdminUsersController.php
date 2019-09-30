<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use App\Stand;
use App\Userskin;
use App\Level;

class AdminUsersController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function users() {
        $users = User::all();
        (array) $users;

        return view('admin/users/users', compact('users'));
    }

    public function userEdit($id) {
        $user = User::find($id);
        if(!$user) {
            return redirect('/');
        }
        $stands = Stand::orderBy('name')->get();
        (array) $stands;
        $userskins = Userskin::orderBy('name')->get();
        (array) $userskins;

        return view('admin/users/userEdit', compact('user', 'stands', 'userskins'));
    }

    public function userEditSave($id, Request $request) {

        $user = User::find($id);
        if(!$user) {
            return redirect('/');
        }
        $validator = Validator::make($request->all(), [
            'user_username' => 'required|max:191',
            'user_stand_id' => 'required'
        ]);
        // TODO: add validations for every field
        //
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/users/add'))->with('errors', $errors);
        }
        $level_id = Level::where('level', $request->has('user_level') ? $request->input('user_level') : $user->level()->level)->first()->id;
        $user->update([
            'discord_id' => $request->has('user_discord_id') ? $request->input('user_discord_id') : $user->discord_id,
            'username' => $request->has('user_username') ? $request->input('user_username') : $user->username,
            'userlevel'=> $request->has('user_userlevel') ? $request->input('user_userlevel') : $user->userlevel,
            'money'=> $request->has('user_money') ? $request->input('user_money') : $user->money,
            'userskin_id'=> $request->has('user_userskin_id') ? $request->input('user_userskin_id') : $user->userskin_id,
            'stand_id' => $request->has('user_stand_id') ? $request->input('user_stand_id') : $user->stand_id,
            'health' => $request->has('user_health') ? $request->input('user_health') : $user->health,
            'power_min' => $request->has('user_power_min') ? $request->input('user_power_min') : $user->power_min,
            'power_max' => $request->has('user_power_max') ? $request->input('user_power_max') : $user->power_max,
            'power' => $request->has('user_power') ? $request->input('user_power') : $user->power,
            'speed' => $request->has('user_speed') ? $request->input('user_speed') : $user->speed,
            'range' => $request->has('user_range') ? $request->input('user_range') : $user->range,
            'durability' => $request->has('user_durability') ? $request->input('user_durability') : $user->durability,
            'precision' => $request->has('user_precision') ? $request->input('user_precision') : $user->precision,
            'potential' => $request->has('user_potential') ? $request->input('user_potential') : $user->potential,
            'level_id' => $level_id,
            'experience' => $request->has('user_experience') ? $request->input('user_experience') : $user->experience
        ]);

        return redirect(url('/admin/users'));
    }

    public function ajaxLevel(Request $request) {
        if(!$request->ajax()){
            return back();
        }
        if($request->level == null) {
            return;
        }
        $level = Level::where('level', $request->level+1)->first();
        if(!$level) {
            return;
        }
        return $level;
    }
}
