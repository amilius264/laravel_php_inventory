<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $table = 'customer';
    protected $fillable = [
    	'npwp',
    	'nama_cust',
    	'kontak',
    	'alamat'
    ];
}
