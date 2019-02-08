<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
// use this to use normal sql
//use DB;

class ClientsController extends Controller
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
		$clients = Client::orderBy('created_at','desc')->paginate(10);
        return view('clients.index')->with('clients',$clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
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
			'body' => 'required'
			
		]);
		// Create Client
		$client = new Client;
		$client->title = $request->input('title');
		$client->body = $request->input('body');
		$client->user_id = auth()->user()->id;
		$client->save();
		
		return redirect('/clients')->with('success', 'Client Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		//this returns a single Client -it uses Eloquent
        $client = Client::find($id);
		return view('clients.show')->with('client',$client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
		
		//Check for correct user
		if(auth()->user()->id !==$client->user_id) {
			return redirect('/clients')->with('error', 'Unauthorized page');
		}
		
		return view('clients.edit')->with('client',$client);
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
		// Create Client
		$client = Client::find($id);
		$client->title = $request->input('title');
		$client->body = $request->input('body');
		$client->save();
		
		return redirect('/clients')->with('success', 'Client Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
		//Check for correct user
		if(auth()->user()->id !==$client->user_id) {
			return redirect('/clients')->with('error', 'Unauthorized page');
		}
		
		$client->delete();
		return redirect('/clients')->with('success', 'Client Removed.');
    }
}
