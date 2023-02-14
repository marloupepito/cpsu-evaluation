<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalResult extends Model
{
   protected $table = 'final_result';
    use HasFactory;
     protected $fillable = [
      'campusid',
     'faculty_id',
      'faculty_name',
       'student',
        'peer',
        'self',
        'supervisor',
        'sy',
        'sem',
    ];
}
