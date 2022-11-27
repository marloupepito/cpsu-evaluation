<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubjectLoading extends Model
{
    use HasFactory;
    protected $table = 'student_subject_loading';
     protected $fillable = [
            'id_number',
            'campusid',
            'subject',
            'campus',
            'semester',
            'school_year',
            'section',
            'year',
            'program',
            'program2',
            'evaluator_id'
    ];
}
