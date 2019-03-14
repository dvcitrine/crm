<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Client;
use View;
// use this to use normal sql
//use DB;

class ContactsController extends Controller
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
		$contacts = Contact::orderBy('created_at','desc')->get();
        return view('contacts.index')->with('contacts',$contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$clients = Client::where('active', '1')->get();
        return view('contacts.create',compact('clients'));
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
			'email' => 'required|email',
			'name' => 'required',
			'afm' => 'digits:9',
			'tk' => 'digits:5',
			'telephone' => 'required|digits:10',
			
		]);
		// Create Contact
		$contact = new Contact;
		$contact->name = $request->input('name');
		$contact->telephone = $request->input('telephone');
		$contact->email = $request->input('email');
		$contact->occupation = $request->input('occupation');
		$contact->client_id = $request->input('client');
		$contact->notes = $request->input('notes');				
		$contact->afm = $request->input('afm');
		$contact->address = $request->input('address');
		$contact->tk = $request->input('tk');
		$contact->user_id = auth()->user()->id;
		$contact->active = $request->input('active');
		$contact->save();
		
		return redirect('/contacts')->with('success', 'Contact Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		//this returns a single Contact -it uses Eloquent
        $contact = Contact::find($id);
		return view('contacts.show')->with('contact',$contact);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
		$clients = Client::where('active', '1')->get();
		
		//Check for correct user
		if(auth()->user()->id !==$contact->user_id) {
			return redirect('/contacts')->with('error', 'Unauthorized page');
		}
		
		return view('contacts.edit',compact('contact','clients'));
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
			'email' => 'required|email',
			'name' => 'required',
			'afm' => 'digits:9',
			'tk' => 'digits:5',
			'telephone' => 'required|digits:10',
			
		]);
		// Update Contact
		$contact = Contact::find($id);
		$contact->name = $request->input('name');
		$contact->telephone = $request->input('telephone');
		$contact->email = $request->input('email');
		$contact->occupation = $request->input('occupation');
		$contact->client_id = $request->input('client');
		$contact->notes = $request->input('notes');				
		$contact->afm = $request->input('afm');
		$contact->address = $request->input('address');
		$contact->tk = $request->input('tk');
		$contact->active = $request->input('active');
		$contact->save();
		
		return redirect('/contacts')->with('success', 'Contact Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
		//Check for correct user
		if(auth()->user()->id !==$contact->user_id) {
			return redirect('/contacts')->with('error', 'Unauthorized page');
		}
		
		//$contact->delete();
		//return redirect('/contacts')->with('success', 'Contact Removed.');
    }
}
