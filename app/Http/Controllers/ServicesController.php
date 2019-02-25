<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
// use this to use normal sql
//use DB;

class ServicesController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
		 $this->middleware('checkadmin');
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$services = Service::orderBy('created_at','desc')->paginate(10);
		//return $service = Service::where('title','Service Two')->get();
		//$services  =DB::select('SELECT * FROM services');
        return view('services.index')->with('services',$services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
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
			'title' => 'required',
			'service_code' => 'required'
			
		]);
		// Create Service
		$service = new Service;
		$service->title = $request->input('title');
		$service->service_code = $request->input('service_code');
		$service->save();
		
		return redirect('/services')->with('success', 'Service Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		//this returns a single service -it uses Eloquent
        $service = Service::find($id);
		return view('services.show')->with('service',$service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
		

		
		return view('services.edit')->with('service',$service);
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
			'service_code' => 'required'
			
		]);
		// Create Service
		$service = Service::find($id);
		$service->title = $request->input('title');
		$service->service_code = $request->input('service_code');
		$service->save();
		
		return redirect('/services')->with('success', 'Service Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
		//Check for correct user

		
		$service->delete();
		return redirect('/services')->with('success', 'Service Removed.');
    }
}
