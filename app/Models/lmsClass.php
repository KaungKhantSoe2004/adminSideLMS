<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lmsClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name','school_id','created_by'
    ];
}
