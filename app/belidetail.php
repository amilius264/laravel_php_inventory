<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class belidetail extends Model
{
	protected $table = 'belidetail';
	protected $fillable = [
	    'beli_id',
	    'barang_id',
	    'price',
	    'jumlah',
	    'diskon',
	    'ppn',
	    'total'
    ];

    public function beli()
    {
        return $this->belongsTo(beli::class);
    }

    public function status()
    {
        return $this->belongsTo(t_status::class);
    }

    public function barang()
    {
        return $this->belongsTo(barang::class);
    }
    
    public function suplier()
    {
        return $this->belongsTo(suplier::class);
    }

    public function satuan()
    {
        return $this->belongsTo(satuan::class);
    }
}
