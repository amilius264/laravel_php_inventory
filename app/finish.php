<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class finish extends Model
{
    protected $table = 'finish';
    protected $fillable = [
    	'beli_id',
    	'status'
    ];
}
