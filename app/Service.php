<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //Table Name. Optional if set to the plural of the model name
	protected $table = 'services';
	//Primary key. Optional if set to 'id'
	public $primaryKey = 'id';
	
	//Model Relationships
	public function project_codes(){
		return $this->hasMany('App\ProjectCode');
	}
}
