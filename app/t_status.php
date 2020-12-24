<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class t_status extends Model
{
    protected $table = 't_status';
    protected $fillable = [
	    'nama_status'
	];

	public function beli()
    {
    	return $this->hasMany(beli::class);
    }

    public function belidetail()
    {
    	return $this->hasMany(belidetail::class);
    }
}
