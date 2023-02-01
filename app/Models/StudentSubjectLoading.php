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
            'unique_id',
            'campusid',
            'subject',
            'campus',
            'semester',
            'school_year',
            'section',
            'year',
            'comment',
            'type',
            'faculty_name',
            'academic_rank',
            'program',
            'program2',
            'evaluator_id',
            'sy',
            'total'
    ];
}
