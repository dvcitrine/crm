<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table Name. Optional if set to the plural of the model name
	protected $table = 'posts';
	//Primary key. Optional if set to 'id'
	public $primaryKey = 'id';
	
	//Model Relationships
	public function user(){
		return $this->belongsTo('App\User');
	}
}
