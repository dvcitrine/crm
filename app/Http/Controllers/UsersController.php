<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UsersController extends Controller
{

	public function index(){
		//$users = User::all();
		$users = 'φφφ';
		$title = 'Admin';
		//return view('admin')->with('users',$users );
		return view('admin')->with('title',$title);
	}

}
