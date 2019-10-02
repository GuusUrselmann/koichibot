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

    public function userAdd() {
        return view('admin/users/userAdd', compact('stands'));
    }

    public function userEdit($id) {
        $user = User::find($id);
        if(!$user) {
            return redirect('/admin/users');
        }
        $stands = Stand::orderBy('name')->get();
        (array) $stands;
        $userskins = Userskin::orderBy('name')->get();
        (array) $userskins;
        $userskins_unlocked_ids = explode(',', $user->unlocks_userskins);
        $userskins_unlocked = Userskin::findMany($userskins_unlocked_ids);
        (array) $userskins_unlocked;

        return view('admin/users/userEdit', compact('user', 'stands', 'userskins', 'userskins_unlocked'));
    }

    public function userEditSave($id, Request $request) {

        $user = User::find($id);
        if(!$user) {
            return redirect('/admin/users');
        }
        $power_min = $request->has('user_power_min') ? $request->input('user_power_min') : $user->power_min;
        $level_level = $request->has('user_level') ? $request->input('user_level') : $user->level;
        $level = Level::where('level', $level_level+1)->first();
        $validator = Validator::make($request->all(), [
            'user_discord_id' => ['required', 'numeric', 'min:0'],
            'user_username' => ['required', 'regex:/^[a-zA-Z0-9]+#[0-9]{4}$/'],
            'user_userlevel' => ['required', 'in:owner,admin,member'],
            'user_money' => ['required', 'numeric', 'min:0'],
            'user_stand_id' => ['numeric', 'min:0'],
            'user_health' => ['required', 'numeric', 'min:0'],
            'user_power_min' => ['numeric', 'min:0'],
            'user_power_max' => ['numeric', 'min:'.$power_min],
            'user_power' => ['in:E,D,C,B,A,UNKNOWN'],
            'user_speed' => ['in:E,D,C,B,A,UNKNOWN'],
            'user_range' => ['in:E,D,C,B,A,UNKNOWN'],
            'user_durability' => ['in:E,D,C,B,A,UNKNOWN'],
            'user_precision' => ['in:E,D,C,B,A,UNKNOWN'],
            'user_potential' => ['in:E,D,C,B,A,UNKNOWN'],
            'user_level' => ['required', 'numeric', 'min:0'],
            'user_experience' => ['required', 'numeric', 'min:0', 'max:'.$level->experience],
            'user_unlocks_userskins' => ['required', 'regex:/^\d+(,\d+)*$/']
        ]);
        // TODO: addalidation and leveling up for experience????
        //
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/users/'.$user->id.'/edit'))->with('errors', $errors);
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
            'experience' => $request->has('user_experience') ? $request->input('user_experience') : $user->experience,
            'unlocks_userskins' => $request->has('user_unlocks_userskins') ? $request->input('user_unlocks_userskins') : $user->unlocks_userskins
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
