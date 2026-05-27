<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
     protected $table = 'students';

    protected $primaryKey = 'student_id';

    protected $fillable = [
        'name',
        'lastname',
        'identity_document',
        'mother_s_identity_document',
        'birth',
        'age',
        'descripcion',
        'slug'
    ];

      public function Subject(){
        return $this->belongsTo(Subject::class, 'subject_id' );
    }

     public function Student(){
        return $this->belongsTo(Student::class, 'student_id' );
    }
}
