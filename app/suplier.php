<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class suplier extends Model
{
    protected $table = 'suplier';
    protected $fillable = [
    	'npwp',
    	'kode_sup',
    	'nama_sup',
        'alamat',
    	'kontak'
    ];

    public function barang()
    {
    	return $this->hasMany(barang::class);
    }
}
