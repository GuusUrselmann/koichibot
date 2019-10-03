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

    public function levelAdd() {
        $level_next = Level::count()+1;
        $errors = session('data')['errors'];

        return view('admin/levels/levelAdd', compact('level_next', 'errors'));
    }

    public function levelEdit($id) {
        $level = Level::find($id);
        if(!$level) {
            return redirect('/admin/levels');
        }
        $errors = session('data')['errors'];

        return view('admin/levels/levelEdit', compact('level', 'errors'));
    }

    function levelDelete($id, Request $request) {
        $level = Level::find($id);
        if(!$level) {
            return redirect('/admin/levels');
        }
        $level->delete();
        return redirect('/admin/levels');
    }

    public function levelAddSave(Request $request) {
        $validator = Validator::make($request->all(), [
            'level_level' => ['required', 'numeric', 'min:1', 'unique:levels,level'],
            'level_experience' => ['required', 'numeric', 'min: 1']
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
            return redirect(url('/admin/levels/add'))->with('data', ['errors' => $errors, 'modals' => $modals]);
        }
        Level::create([
            'level' => $request->input('level_level'),
            'experience' => $request->input('level_experience')
        ]);

        return redirect(url('/admin/levels'));
    }

    public function levelEditSave($id, Request $request) {
        $level = Level::find($id);
        if(!$level) {
            return redirect('/admin/levels');
        }
        $validator = Validator::make($request->all(), [
            'level_experience' => ['required', 'numeric', 'min: 1']
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
            return redirect(url('/admin/levels/add'))->with('data', ['errors' => $errors, 'modals' => $modals]);
        }
        $level->update([
            'experience' => $request->input('level_experience')
        ]);

        return redirect(url('/admin/levels'));
    }
}
