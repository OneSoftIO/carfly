<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;

class UsersController extends Controller
{
    public function index(){
        $users = User::whereNotNull('password')->orderBy('created_at', 'DESC')->get();

		return view('admin.users.users', compact('users'));
	}
	public function create(){
		$roles = ['admin'];
		return view('admin.users.create', compact('roles'));
	}
	public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

	    return back()->with('success', 'Išsaugota');
    }
	public function edit(User $user){
        return view('admin.users.edit', compact('user'));
    }

    public function destroy($id){
	    User::destroy($id);

	    return back()->with('success', 'Pašalinta sėkmingai');
    }
}
