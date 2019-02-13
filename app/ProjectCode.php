<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectCode extends Model
{
    //Table Name. Optional if set to the plural of the model name
	protected $table = 'project_codes';
	//Primary key. Optional if set to 'id'
	public $primaryKey = 'id';
	
	//Model Relationships
	public function client(){
		return $this->belongsTo('App\Client');
	}
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function assigned_users(){
		return $this->belongsToMany('App\User');
	}
	public function service(){
		return $this->belongsTo('App\Service');
	}
	public function hours(){
		return $this->hasMany('App\Hour');
	}
	
	
	public function is_project_assigned_to_user($id){
		if($this->assigned_users()->where('user_id', $id)->first()){
			return true;
		}
		return false;
	}
	
}
