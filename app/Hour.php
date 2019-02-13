<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    //Table Name. Optional if set to the plural of the model name
	protected $table = 'hours';
	//Primary key. Optional if set to 'id'
	public $primaryKey = 'id';
	
	//Model Relationships
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function project_code(){
		return $this->belongsTo('App\ProjectCode');
	}
}
