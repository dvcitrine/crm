<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //Table Name. Optional if set to the plural of the model name
	protected $table = 'contacts';
	//Primary key. Optional if set to 'id'
	public $primaryKey = 'id';
	
	//Model Relationships
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function client(){
		return $this->belongsTo('App\Client');
	}
}
