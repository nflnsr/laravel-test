<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'divisions';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false; 
    public $timestamps = false; 
}
