<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	//Model Relationships
	public function posts(){
		return $this->hasMany('App\Post');
	}
	public function hour(){
		return $this->hasMany('App\Hour');
	}
	public function clients(){
		return $this->hasMany('App\Client');
	}
	
    public function roles(){
		return $this->belongsToMany('App\Role');
	}	
	public function project_codes(){
		return $this->hasMany('App\ProjectCode');
	}
	public function assigned_project_codes(){
		return $this->belongsToMany('App\ProjectCode');
	}

	
	
	
	public function hasAnyRole($roles){
		if(is_array($roles)){
			foreach($roles as $role ){
				if($this->hasRole($role)){
					return true;
				}
			}
		} else {
			if($this->hasRole($roles)){
					return true;
				}
		}
		return false;
	}
	
	public function hasRole($role){
		if($this->roles()->where('name', $role)->first()){
			return true;
		}
		return false;
	}
	
}
