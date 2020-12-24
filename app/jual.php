<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jual extends Model
{
    protected $table = 'jual';
    protected $fillable = [
	    'customer_id',
	    'status_id',
	    'sales_id',
	    'tanggal_jual',
	    'tanggal_tempo',
	    'faktur_no',
	    'note'
	];

	public function status()
    {
        return $this->belongsTo(t_status::class);
    }

    public function customer()
    {
    	return $this->belongsTo(customer::class);
    }

    public function sales()
    {
    	return $this->belongsTo(sales::class);
    }

    public function details()
    {
    	return $this->hasMany('App\jualdetail','jual_id');
    }    

    public function total()
    {
    	$po = $this->id;

    	$total = jualdetail::where('jual_id',$po)->sum('total');
    	return $total;
    }    
}
