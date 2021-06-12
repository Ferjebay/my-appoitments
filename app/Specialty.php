<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model{
    
    //$specialty->doctors
	public function users(){
		return $this->belongsToMany(User::class)->withTimestamps();
	}

}
