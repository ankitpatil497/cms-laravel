<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\User;
use Illuminate\Http\Request;
use PDO;

class UsersController extends Controller
{
    //
    public function index(){
        return view('users.index')->with('users',User::all());
    }

    public function makeAdmin($user){
        $user=User::find($user);
        $user->role='admin';
        $user->save();

        session()->flash('success','User made admin succesfully');

        return redirect(route('user.index'));
    }

    public function edit(){
        return view('users.edit')->with('user',auth()->user());
    }

    public function update(UpdateProfileRequest $request){
        $user=auth()->user();

        $user->update([
            'name'=>$request->name,
            'about'=>$request->name
        ]);

        session()->flash('success','User Update succesfully');
        return redirect(route('home'));

    }
}
