<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectList extends Model
{
    use HasFactory;
    protected $table = 'subject_list';
    protected $fillable = [
            'subject',
            'department',
            'semester',
            'year'
    ];
}
