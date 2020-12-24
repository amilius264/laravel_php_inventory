<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    protected $table = 'sales';
    protected $fillable = [
    	'nama_sales',
    	'kontak',
    	'alamat',
    	'aktif'
    ];
}
