<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jualdetail extends Model
{
    protected $table = 'jualdetail';
	protected $fillable = [
	    'jual_id',
	    'barang_id',
	    'satuan_id',
	    'qty',
	    'price',
	    'disc',
	    'total',
    ];

    public function jual()
    {
        return $this->belongsTo(jual::class);
    }

    public function status()
    {
        return $this->belongsTo(t_status::class);
    }

    public function barang()
    {
        return $this->belongsTo(barang::class);
    }
    
    public function satuan()
    {
        return $this->belongsTo(satuan::class);
    }

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    public function sales()
    {
        return $this->belongsTo(sales::class);
    }
}
