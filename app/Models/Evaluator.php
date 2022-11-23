<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluator extends Model
{	
    use HasFactory;
    protected $table = 'evaluator';
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
       'year'
    ];
}
