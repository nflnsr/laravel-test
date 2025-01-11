<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'image',
        'name',
        'phone',
        'division_id',
        'position',
    ];
    
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
