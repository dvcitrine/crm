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
	
	    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {		
		$user = User::find($id);
		//this returns a single ProjectCode -it uses Eloquent
		return view('users.show',compact('user'));
    }
	

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
		$roles = Role::all();
		//this returns a single ProjectCode -it uses Eloquent
		return view('users.edit',compact('user','roles'));
    }
	
    public function update(Request $request, $id)
    {
		// Create user role
		$user = User::find($id);
		$user->title = $request->input('title');
		$user->body = $request->input('body');
		$user->body = $request->input('role');
		$user->save();
		
		return redirect('/users')->with('success', 'User role Updated.');
    }
}
