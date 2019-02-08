<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UsersController extends Controller
{

	public function index(){
		$users = User::all();
		//$users = 'φφφ';
		$title = 'Admin';
		return view('users.index')->with('users',$users );
		//return view('admin')->with('title',$title);
		//return view('users.index');
	}
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'title' => 'required',
			'body' => 'required'
			
		]);
		// Create user role
		$user = User::find($id);
		$user->title = $request->input('title');
		$user->body = $request->input('body');
		$user->save();
		
		return redirect('/users')->with('success', 'User role Updated.');
    }
}
