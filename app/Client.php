<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //Table Name. Optional if set to the plural of the model name
	protected $table = 'clients';
	//Primary key. Optional if set to 'id'
	public $primaryKey = 'id';
	
	//Model Relationships
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function project_codes(){
		return $this->hasMany('App\ProjectCode');
	}
}
