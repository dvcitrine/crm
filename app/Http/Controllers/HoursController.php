<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hour;
use App\ProjectCode;
use App\Service;
use App\Client;
use App\User;
// use this to use normal sql
//use DB;

class HoursController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//$project_codes = '';
		$project_codes = User::find(auth()->user()->id)->assigned_project_codes;
		//$clients = $project_codes->client_id;
		$client_ids=[];
		foreach ($project_codes as $project_code){
			$client_ids[]=$project_code['client_id'];
		}
		$clients = Client::whereIn('id',$client_ids)->get();
		$today = date('l, j / n / Y');
		$today_timestamp = strtotime("today");
		//$hours = Hour::orderBy('created_at','desc')->paginate(10);
		$hours = Hour::orderBy('created_at','desc')->where('date', $today_timestamp)->where('user_id', 'like', auth()->user()->id)->get();
		//$hours = $hours_all->user;
        return view('hours.index',compact('hours','today','project_codes','clients','today_timestamp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {	
		$clients = Client::all();
		$services = Service::all();
		$users = User::all();
        return view('hours.create',compact('clients','services','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// Create Hour
		$hour = new Hour;
		$hour->project_code_id = $request->input('project_code_id');
		$hour->description = $request->input('description');
		$hour->date = $request->input('timestamp');
		$hour->minutes = (intval($request->input('hours')))*60 + intval($request->input('minutes'));
		$hour->user_id = auth()->user()->id;
		
		//$hour->save()->assigned_users()->attach($assigned_to);
		$hour->save();
		return redirect('/')->with('success', 'Task Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {		
		$users = Hour::find($id)->assigned_users;
		//this returns a single Hour -it uses Eloquent
        $project_code = Hour::find($id);
		$client = Client::find($project_code->client_id);
		$service = Service::find($project_code->service_id);
		//return view('hours.show')->with('project_code',$hour);
		return view('hours.show',compact('project_code','client','users','service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project_code = Hour::find($id);
		//$users = Hour::find($id)->assigned_users;
		$users = User::all();
		$services = Service::all();
		$clients = Client::all();
		$chosen_client = Client::find($project_code->client_id);
		//Check for correct user
		if((auth()->user()->hasRole('author'))) {
		//(auth()->user()->roles());
			return redirect('/project-codes')->with('error', 'Unauthorized page');
		}
		
		return view('hours.edit',compact('project_code','clients','users','chosen_client','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'title' => 'required',
			'body' => 'required'
			
		]);
		// Create Hour
		$hour = Hour::find($id);
		$hour->title = $request->input('title');
		$hour->body = $request->input('body');
		$hour->client_id = $request->input('client');
		$hour->service_id = $request->input('service');
		$assigned_to = $request->input('user_id');
		
		$hour->save();
		$hour->assigned_users()->sync($assigned_to);
		
		return redirect('/project-codes')->with('success', 'Project code updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hour = Hour::find($id);
		$client = Client::find($hour->client_id);
		
		//Check for correct user
		if(auth()->user()->id !==$client->user_id) {
			return redirect('/hours')->with('error', 'Unauthorized page');
		}
		$hour->assigned_users()->sync([]);
		$hour->delete();
		return redirect('/hours')->with('success', 'Hour Removed.');
    }
}
