<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'year',
        'members',
        'abstract',
        'document',
        'description',
        'student_department',
        'student_lastname',
        'student_firstname',
        'citation',
        'studentid',
        'status',
    ];
    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }
}
