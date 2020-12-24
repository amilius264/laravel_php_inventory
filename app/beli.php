<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\belidetail;

class beli extends Model
{
	protected $table = 'beli';
	 protected $fillable = [
	    'suplier_id',
	    'tanggal_beli',
	    'noinv',
	    'note'
	];

    public function suplier()
    {
    	return $this->belongsTo(suplier::class);
    }

	public function lines()
    {
    	return $this->hasMany('App\belidetail','beli_id');
    }    

    public function total()
    {
    	$po = $this->id;

    	$total = belidetail::where('beli_id',$po)->sum('total');
    	return $total;
    }    

    public function status()
    {
        return $this->belongsTo('App\t_status','nama_status');
    }
}
