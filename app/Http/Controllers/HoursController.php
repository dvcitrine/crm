<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hour;
use App\ProjectCode;
use App\Service;
use App\Client;
use App\User;
use View;

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
        $this->middleware('auth');
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
		$hours = Hour::orderBy('created_at','asc')->where('date', $today_timestamp)->where('user_id', 'like', auth()->user()->id)->get();
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
		$hour->project = $hour->project_code;		
		return response()->json($hour);
		//return redirect('/')->with('success', 'Task Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {		
		$id = $request->input('id');
		//$project = Hour::find($id)->project_code;
		//this returns a single Hour -it uses Eloquent
        $hour = Hour::find($id);
		//$hour->project = Hour::find($id)->project_code;
		
		return response()->json($hour);
		//return view('hours.show',compact('hour','client','users','service'));
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
    public function update(Request $request)
    {
        $this->validate($request, [
			//'title' => 'required',
			//'body' => 'required'
			
		]);
		$id = $request->input('id');
		// Update Hour
		$hour = Hour::find($id);
		$hour->project_code_id = $request->input('project_code_id');
		$hour->description = $request->input('description');
		$hour->date = $request->input('timestamp');
		$hour->minutes = (intval($request->input('hours')))*60 + intval($request->input('minutes'));		
		$hour->save();
		$hour->project = $hour->project_code;
		return response()->json($hour);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_hour(Request $request)
    {
		$id = $request->input('id');
        $hour = Hour::find($id);
		$hour->delete();
		//return redirect('/hours')->with('success', 'Hour Removed.');
		return response()->json($hour);
    }
	
	    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadhours(Request $request)
    {
		//$project_codes = '';
		$project_codes = User::find(auth()->user()->id)->assigned_project_codes;
		$current_date = $request->input('current_date');
		//$clients = $project_codes->client_id;
		$client_ids=[];
		foreach ($project_codes as $project_code){
			$client_ids[]=$project_code['client_id'];
		}
		$clients = Client::whereIn('id',$client_ids)->get();
		$hours = Hour::orderBy('created_at','desc')->paginate(10);
		//$hours = Hour::orderBy('created_at','asc')->where('date', $current_date)->get();
		$hours = Hour::orderBy('created_at','asc')->where('date', $current_date)->where('user_id', 'like', auth()->user()->id)->get();
		//$hours = $hours_all->user;
        return view('hours.loadhours',compact('hours','project_codes','clients','current_date'));
		//return response()->json($hour);
		//return View::make('hours.loadhours',compact('hours','project_codes','clients'))->render();
    }
	
	
	
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports()
    {
		$today = date('l, j / n / Y');
		$today_timestamp = strtotime("today");
		$first_day = strtotime(date('Y-m-01'));
		$today = date('F Y');
		
		//$project_codes = '';
		$project_codes = ProjectCode::where('active', '1')->get();
		//$clients = $project_codes->client_id;
		$clients = array();
		foreach ($project_codes as $project_code){
			$include_project = 0;
			$time_hours = 0;
			$time_minutes= 0;
			//$hours = Hour::orderBy('created_at','asc')->whereBetween('date', [$first_day, $today_timestamp])->where('project_code_id', $project_code->id)->where('user_id', 'like', auth()->user()->id)->get();
			$hours = Hour::orderBy('created_at','asc')->where('project_code_id', $project_code->id)->whereBetween('date', [$first_day, $today_timestamp])->where('user_id', 'like', auth()->user()->id)->get();
			$count = $hours->count();
			if ($count>0){
				$include_project = 1;
				$time = 0;
				foreach ($hours as $hour){
					$time += $hour->minutes;
				}
				$time_hours = floor(($time)/60);
				$time_minutes = (($time)%60);
				$time_minutes = sprintf("%02d", $time_minutes);
				$clients[$project_code->client->id] = $project_code->client->nickname;
			}
			$project_code->include_project = $include_project;
			$project_code->time_hours = $time_hours;
			$project_code->time_minutes = $time_minutes;
		}		
		//$hours = Hour::orderBy('created_at','desc')->paginate(10);		
		//$hours = $hours_all->user;
        return view('hours.reports',compact('today','project_codes','clients','today_timestamp','first_day'));

    }
	
	public function loadhoursinreport(Request $request)
	{
		//$today = date('l, j / n / Y');
		//$today_timestamp = strtotime("today");
		//$first_day = strtotime(date('Y-m-01'));
		//$today = date('F Y');
		$start_date = $request->input('start_date');
		$month = date("M Y", $start_date);
		if($request->input('end_date')){
			$last_day = $request->input('end_date');
		}
		else {
			$last_day = strtotime('last day of ' . $month);
		}
		$project_codes = ProjectCode::where('active', '1')->get();
		$client_ids=[];
		foreach ($project_codes as $project_code){
			$include_project = 0;
			$time_hours = 0;
			$time_minutes= 0;
			$hours = Hour::orderBy('created_at','asc')->where('project_code_id', $project_code->id)->whereBetween('date', [$start_date, $last_day])->where('user_id', 'like', auth()->user()->id)->get();
			$count = $hours->count();
			if ($count>0){
				$include_project = 1;
				$time = 0;
				foreach ($hours as $hour){
					$time += $hour->minutes;
				}
				$time_hours = floor(($time)/60);
				$time_minutes = (($time)%60);
				$time_minutes = sprintf("%02d", $time_minutes);
			}
			$project_code->include_project = $include_project;
			$project_code->time_hours = $time_hours;
			$project_code->time_minutes = $time_minutes;
		}
		$clients = Client::whereIn('id',$client_ids)->get();
		
		//$hours = Hour::orderBy('created_at','desc')->paginate(10);
		
		//$hours = $hours_all->user;
        //return view('hours.loadhoursreport',compact('project_codes','start_date','last_day'));
		/*return \Response::json([
            'view_1' => view('hours.loadhoursreport',compact('project_codes','start_date','last_day'))->render()
        ]);*/
		

		$returnHTML = view('hours.loadhoursreport',compact('project_codes','start_date','last_day'))->render();
		//$returnHTML = trim(preg_replace('/\r\n/', ' ', $returnHTML));
//return response()->json(array('success' => true, 'view_1'=>$returnHTML));
//echo json_encode(array('success1' => true, 'view_1'=>$returnHTML));
return \Response::json(array('view_1' => $returnHTML, 'status' => 'OK'));
	}	
	
/*	
	public function reports_hours()
    {
		$project_codes = User::find(auth()->user()->id)->assigned_project_codes;
		$client_ids=[];
		foreach ($project_codes as $project_code){
			$client_ids[]=$project_code['client_id'];
		}
		$clients = Client::whereIn('id',$client_ids)->get();
		$today = date('l, j / n / Y');
		$today_timestamp = strtotime("today");
		$first_day = strtotime(date('Y-m-01'));
		$today = date('F Y');
		$hours = Hour::orderBy('created_at','asc')->whereBetween('date', [$first_day, $today_timestamp])->where('user_id', 'like', auth()->user()->id)->get();
        return view('hours.reports',compact('hours','today','project_codes','clients','today_timestamp','first_day'));
    }
	*/
	
	
}
