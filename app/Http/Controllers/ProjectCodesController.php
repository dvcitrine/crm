<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectCode;
use App\Service;
use App\Client;
use App\User;
use DateTime;
// use this to use normal sql
//use DB;

class ProjectCodesController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index', 'show']]);
		$this->middleware('auth');
		$this->middleware('checkifuser');
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$projectcodes = ProjectCode::orderBy('created_at','desc')->get();
        return view('project_codes.index')->with('project_codes',$projectcodes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {	
		//$clients = Client::all();
		$clients = Client::where('active', '1')->get();
		$services = Service::all();
		$users = User::all();
        return view('project_codes.create',compact('clients','services','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'month' => 'required',
			'year' => 'required',
			'client' => 'required',
			'service' => 'required',
			'description' => 'required'
		]);
		// Create ProjectCode
		$projectcode = new ProjectCode;
		$projectcode->title = $request->input('title-client').$request->input('title-description').$request->input('title-month').$request->input('title-year').$request->input('title-service');
		$projectcode->body = $request->input('body');
		$projectcode->description = $request->input('description');
		$projectcode->client_id = $request->input('client');
		$projectcode->service_id = $request->input('service');
		$projectcode->month = $request->input('month');
		$projectcode->year = $request->input('year');
		$start_date = DateTime::createFromFormat('d/m/Y', $request->input('start-date'));
		$projectcode->start_date = $start_date->format('Y-m-d');
		$end_date = DateTime::createFromFormat('d/m/Y', $request->input('end-date'));
		$projectcode->end_date = $end_date->format('Y-m-d');
		$projectcode->internal_link = $request->input('internal-link');
		$projectcode->client_link = $request->input('client-link');
		$projectcode->active = $request->input('active');
		$projectcode->user_id = auth()->user()->id;
		$assigned_to = $request->input('user_id');
			
		//$projectcode->save()->assigned_users()->attach($assigned_to);
		$projectcode->save();
		$projectcode->assigned_users()->sync($assigned_to);
		return redirect('/projects')->with('success', 'Project Code Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {		
		$users = ProjectCode::find($id)->assigned_users;
		//this returns a single ProjectCode -it uses Eloquent
        $project_code = ProjectCode::find($id);
		$client = Client::find($project_code->client_id);
		$service = Service::find($project_code->service_id);
		//return view('project_codes.show')->with('project_code',$projectcode);
		return view('project_codes.show',compact('project_code','client','users','service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project_code = ProjectCode::find($id);
		//$users = ProjectCode::find($id)->assigned_users;
		$users = User::where('active', '1')->get();
		$services = Service::all();
		$clients = Client::where('active', '1')->get();
		$chosen_client = Client::find($project_code->client_id);
		//Check for correct user
		if((auth()->user()->hasRole('author'))) {
		//(auth()->user()->roles());
			return redirect('/projects')->with('error', 'Unauthorized page');
		}
		
		return view('project_codes.edit',compact('project_code','clients','users','chosen_client','services'));
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
			'body' => 'required'
			
		]);
		// Create ProjectCode
		$projectcode = ProjectCode::find($id);
		$projectcode->title = $request->input('title-client').$request->input('title-description').$request->input('title-month').$request->input('title-year').$request->input('title-service');
		$projectcode->body = $request->input('body');
		$projectcode->description = $request->input('description');
		$projectcode->client_id = $request->input('client');
		$projectcode->service_id = $request->input('service');
		$projectcode->month = $request->input('month');
		$projectcode->year = $request->input('year');
		$start_date = DateTime::createFromFormat('d/m/Y', $request->input('start-date'));
		$projectcode->start_date = $start_date->format('Y-m-d');
		$end_date = DateTime::createFromFormat('d/m/Y', $request->input('end-date'));
		$projectcode->end_date = $end_date->format('Y-m-d');
		$projectcode->internal_link = $request->input('internal-link');
		$projectcode->client_link = $request->input('client-link');
		$projectcode->active = $request->input('active');
		//$projectcode->user_id = auth()->user()->id;
		$projectcode->user_id = $request->input('manager');
		$assigned_to = $request->input('user_id');
		
		$projectcode->save();
		$projectcode->assigned_users()->sync($assigned_to);
		
		return redirect('/projects')->with('success', 'Project updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projectcode = ProjectCode::find($id);
		$client = Client::find($projectcode->client_id);
		
		//Check for correct user
		if(auth()->user()->id !==$client->user_id) {
			return redirect('/project_codes')->with('error', 'Unauthorized page');
		}
		$projectcode->assigned_users()->sync([]);
		$projectcode->delete();
		return redirect('/projects')->with('success', 'ProjectCode Removed.');
    }
}
