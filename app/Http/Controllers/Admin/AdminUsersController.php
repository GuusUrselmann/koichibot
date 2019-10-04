<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
        $stands = Stand::orderBy('name')->get();
        (array) $stands;
        $userskinDefault = UserSkin::find(1);
        $userskins = Userskin::orderBy('name')->get();
        (array) $userskins;

        $errors = session('data')['errors'];

        return view('admin/users/userAdd', compact('stands', 'userskinDefault', 'userskins', 'errors'));
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

        $errors = session('data')['errors'];

        return view('admin/users/userEdit', compact('user', 'stands', 'userskins', 'userskins_unlocked', 'errors'));
    }

    function userDelete($id, Request $request) {
        $user = User::find($id);
        if(!$user) {
            return redirect('/admin/users');
        }
        $user->delete();
        return redirect('/admin/users');
    }

    public function userAddSave(Request $request) {
        $user = User::where('username', 'messenwerper#9989')->first();
        if($user != null) {
            return ['response' => 'userExist'];
        }
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
        return;
        $power_min = $request->has('user_power_min') ? $request->input('user_power_min') : 0;
        $level_level = $request->has('user_level') ? $request->input('user_level') : 1;
        $level = Level::where('level', $level_level+1)->first();
        $validator = Validator::make($request->all(), [
            'user_discord_id' => ['required', 'numeric', 'min:0'],
            'user_username' => ['required', 'regex:/^[a-zA-Z0-9]+#[0-9]{4}$/'],
            'user_password' => ['required'],
            'user_userlevel' => ['required', 'in:owner,admin,member'],
            'user_money' => ['required', 'numeric', 'min:0'],
            'user_userskin_id' => ['required', 'numeric', 'min:0'],
            'user_stand_id' => ['nullable', 'numeric', 'min:0'],
            'user_health' => ['required', 'numeric', 'min:0'],
            'user_power_min' => ['required', 'numeric', 'min:0'],
            'user_power_max' => ['required', 'numeric', 'min:'.$power_min],
            'user_power' => ['nullable', 'in:E,D,C,B,A,UNKNOWN'],
            'user_speed' => ['nullable', 'in:E,D,C,B,A,UNKNOWN'],
            'user_range' => ['nullable', 'in:E,D,C,B,A,UNKNOWN'],
            'user_durability' => ['nullable', 'in:E,D,C,B,A,UNKNOWN'],
            'user_precision' => ['nullable', 'in:E,D,C,B,A,UNKNOWN'],
            'user_potential' => ['nullable', 'in:E,D,C,B,A,UNKNOWN'],
            'user_level' => ['required', 'numeric', 'min:0'],
            'user_experience' => ['required', 'numeric', 'min:0', 'max:'.$level->experience],
            'user_unlocks_userskins' => ['required', 'regex:/^\d+(,\d+)*$/']
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            $message = '';
            if($errors != null) {
                foreach($errors->all() as $error) {
                    $message .= $error.'<br />';
                }
            }
            $modals = [
                'errors' => [
                    'type' => 'error',
                    'title' => 'Error',
                    'message' => $message,
                    'duration' => 5
                ]
            ];
            return redirect(url('/admin/users/add'))->with('data', ['errors' => $errors, 'modals' => $modals]);
        }
        $level_id = Level::where('level', $request->has('user_level') ? $request->input('user_level') : 1)->first()->id;
        User::create([
            'discord_id' => $request->input('user_discord_id'),
            'username' => $request->input('user_username'),
            'password' => Hash::make($request->input('user_password')),
            'userlevel'=> $request->input('user_userlevel'),
            'money'=> $request->input('user_money'),
            'userskin_id'=> $request->input('user_userskin_id'),
            'stand_id' => $request->has('user_stand_id') ? $request->input('user_stand_id') : null,
            'health' => $request->input('user_health'),
            'power_min' => $request->input('user_power_min'),
            'power_max' => $request->input('user_power_max'),
            'power' => $request->has('user_power') ? $request->input('user_power') : null,
            'speed' => $request->has('user_speed') ? $request->input('user_speed') : null,
            'range' => $request->has('user_range') ? $request->input('user_range') : null,
            'durability' => $request->has('user_durability') ? $request->input('user_durability') : null,
            'precision' => $request->has('user_precision') ? $request->input('user_precision') : null,
            'potential' => $request->has('user_potential') ? $request->input('user_potential') : null,
            'level_id' => $level_id,
            'experience' => $request->input('user_experience'),
            'unlocks_userskins' => $request->input('user_unlocks_userskins')
        ]);

        return redirect(url('/admin/users'));
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
            'user_password' => ['nullable'],
            'user_userlevel' => ['required', 'in:owner,admin,member'],
            'user_money' => ['required', 'numeric', 'min:0'],
            'user_userskin_id' => ['required', 'numeric', 'min:0'],
            'user_stand_id' => ['nullable', 'numeric', 'min:0'],
            'user_health' => ['required', 'numeric', 'min:0'],
            'user_power_min' => ['required', 'numeric', 'min:0'],
            'user_power_max' => ['required', 'numeric', 'min:'.$power_min],
            'user_power' => ['nullable', 'in:E,D,C,B,A,UNKNOWN'],
            'user_speed' => ['nullable', 'in:E,D,C,B,A,UNKNOWN'],
            'user_range' => ['nullable', 'in:E,D,C,B,A,UNKNOWN'],
            'user_durability' => ['nullable', 'in:E,D,C,B,A,UNKNOWN'],
            'user_precision' => ['nullable', 'in:E,D,C,B,A,UNKNOWN'],
            'user_potential' => ['nullable', 'in:E,D,C,B,A,UNKNOWN'],
            'user_level' => ['required', 'numeric', 'min:0'],
            'user_experience' => ['required', 'numeric', 'min:0', 'max:'.$level->experience],
            'user_unlocks_userskins' => ['required', 'regex:/^\d+(,\d+)*$/']
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            $message = '';
            if($errors != null) {
                foreach($errors->all() as $error) {
                    $message .= $error.'<br />';
                }
            }
            $modals = [
                'errors' => [
                    'type' => 'error',
                    'title' => 'Error',
                    'message' => $message,
                    'duration' => 5
                ]
            ];
            return redirect(url('/admin/users/'.$user->id.'/edit'))->with('data', ['errors' => $errors, 'modals' => $modals]);
        }
        $level_id = Level::where('level', $request->has('user_level') ? $request->input('user_level') : $user->level()->level)->first()->id;
        $user->update([
            'discord_id' => $request->input('user_discord_id'),
            'username' => $request->input('user_username'),
            'password' => $request->has('user_password') ? Hash::make($request->input('user_password')) : $user->password,
            'userlevel'=> $request->has('user_userlevel') ? $request->input('user_userlevel') : $user->userlevel,
            'money'=> $request->input('user_money'),
            'userskin_id'=> $request->input('user_userskin_id'),
            'stand_id' => $request->has('user_stand_id') ? $request->input('user_stand_id') : $user->stand_id,
            'health' => $request->input('user_health'),
            'power_min' => $request->input('user_power_min'),
            'power_max' => $request->input('user_power_max'),
            'power' => $request->has('user_power') ? $request->input('user_power') : $user->power,
            'speed' => $request->has('user_speed') ? $request->input('user_speed') : $user->speed,
            'range' => $request->has('user_range') ? $request->input('user_range') : $user->range,
            'durability' => $request->has('user_durability') ? $request->input('user_durability') : $user->durability,
            'precision' => $request->has('user_precision') ? $request->input('user_precision') : $user->precision,
            'potential' => $request->has('user_potential') ? $request->input('user_potential') : $user->potential,
            'level_id' => $level_id,
            'experience' => $request->input('user_experience'),
            'unlocks_userskins' => $request->input('user_unlocks_userskins')
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
