<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $fillable = [
        'student_id',
        'assessment_id',
        'mark',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}
