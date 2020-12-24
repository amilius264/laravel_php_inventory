<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuan';
    protected $fillable = ['id','nama_sat'];


 public function barang()
    {
    	return $this->hasMany(barang::class);
    }

public function belidetail()
    {
    	return $this->hasMany(belidetail::class);
    }
    
}
