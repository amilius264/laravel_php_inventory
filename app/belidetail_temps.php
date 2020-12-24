<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class belidetail_temps extends Model
{
    protected $table = 'belidetail_temps';
    protected $fillable = [
        'barang_id',
        'Temp_price',
        'Temp_jumlah',
        'satuan_id',
        
    ];

	public function barang()
    {
        return $this->belongsTo(barang::class);
    }

    public function satuan()
    {
        return $this->belongsTo(satuan::class);
    }

    
}
