<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class online extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'student_id', 'class_id'
    ];
}
