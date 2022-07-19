<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class scores extends Model
{
    use HasFactory;
    protected $table = "scores";
    protected $fillable = [
        'global_id',
        'school_id',
        'class_id',
        'academic_session_id',
        'term_id',
        'subject_id',
        'student_id',
        'CA1',
        'CA2',
        'CA3',
        'CA4',
        'CA5',
        'CA6',
        'CA7',
        'CA8',
        'EXAM',
        'TOTAL'

    ];

}
