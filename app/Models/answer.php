<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'student_id', 'assignment_id', 'answerFile','created_by'
    ];
}
