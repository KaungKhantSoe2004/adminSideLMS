<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lesson extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'type', 'lessonSource','file','description',  'class_id','subject_id','school_id','created_by'
    ];
}
