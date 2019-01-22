<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UsersController extends Controller
{

	public function admin(){
		$users = User::all();
		$title = 'Admin';
		return view('admin')->with('users',$users );
	}

}
