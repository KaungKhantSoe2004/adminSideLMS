<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lesson extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'type', 'lessonSource', 'subject_id', 'class_id'
    ];
}
