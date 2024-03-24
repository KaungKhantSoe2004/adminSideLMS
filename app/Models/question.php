<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description','firstChoice', 'secondChoice', 'thirdChoice', 'answer','assignment_id'
    ];
}
