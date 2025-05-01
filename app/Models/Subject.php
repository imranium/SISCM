<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subjectCode',
        'subjectName',
        'credit_hours',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_subject', 'subject_id', 'student_id');
    }
    

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class); // One-to-many relationship
    }
}
