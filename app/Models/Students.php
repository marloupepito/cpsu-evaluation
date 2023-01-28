<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
       'id_number',
       'campusid',
       'campus',
       'name',
       'password',
       'course',
       'evaluator_rank',
       'academic_rank',
       'school_year',
       'section',
       'status',
       'semester',
       'year',
       'sy',
       'signature',
    ];
}
