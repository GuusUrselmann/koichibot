<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use App\Stand;

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

        return view('admin/users/userEdit', compact('user', 'stands'));
    }

    public function userEditSave($id, Request $request) {
        $user = User::find($id);
        if(!$user) {
            return redirect('/');
        }
        $validator = Validator::make($request->all(), [
            'user_username' => 'required|max:191',
            'user_power_min' => 'min:0',
            'user_power_max' => 'min:0',
            'user_health' => 'min:0',
            'user_speed' =>'min:0'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/users'));
        }
        $user->update([
            'username' => $request->has('user_username') ? $request->input('user_username') : $user->username,
            'stand_id' => $request->has('user_stand_id') ? $request->input('user_stand_id') : $user->stand_id,
            'power_min' => $request->has('user_power_min') ? $request->input('user_power_min') : $user->power_min,
            'power_max' => $request->has('user_power_max') ? $request->input('user_power_max') : $user->power_max,
            'health' => $request->has('user_health') ? $request->input('user_health') : $user->health,
            'speed' => $request->has('user_speed') ? $request->input('user_speed') : $user->speed
        ]);

        return redirect(url('/admin/users'));
    }
}
