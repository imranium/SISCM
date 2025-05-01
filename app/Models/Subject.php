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
        'name',
        'credit_hours',
    ];

    public function students()
{
    return $this->belongsToMany(Student::class, 'student_subject');
}

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class); // One-to-many relationship
    }
}
