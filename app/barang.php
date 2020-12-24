<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $table = 'barang';
    protected $fillable = [
        'id',
        'kode_brg',
        'nama_brg',
        'min_stok',
        'harga',
        'satuan_id',
        'suplier_id',
        'note'
    ];

    public function suplier()
    {
    	return $this->belongsTo(suplier::class);
    }

    public function satuan()
    {
    	return $this->belongsTo(satuan::class);
    }

    public function belidetail()
    {
        return $this->hasMany(belidetail::class, 'barang_id')->orderBy('id', 'DESC');
    }

    public function belitemp()
    {
        return $this->hasMany(belitemp::class, 'barang_id')->orderBy('id', 'DESC');
    }
}
