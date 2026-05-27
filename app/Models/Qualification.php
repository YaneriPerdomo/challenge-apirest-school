<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{

     protected $table = 'qualifications';

    protected $primaryKey = 'qualification_id';

    protected $fillable = [
        'student_id',
        'subject_id',
        'qualification',
        'slug'
    ];

       public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id' );
    }

     public function Student(){
        return $this->hasOne(Student::class, 'student_id' );
    }

}
