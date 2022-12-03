<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultySubjectLoading extends Model
{
    protected $table = 'faculty_subject_loading';
    use HasFactory;
    protected $fillable = [
        'id_number',
        'campusid',
        'subject',
        'campus',
        'semester',
        'school_year',
        'section',
        'year',
        'department',
        'program',
        'sy',
    ];

}
