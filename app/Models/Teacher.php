<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
     protected $table = 'teachers';

    protected $primaryKey = 'teacher_id';

    protected $fillable = [
        'names',
        'lastnames',
        'identity_document',
        'gender',
        'subject_id',
        'slug',
    ];

     public function Subject(){
        return $this->hasOne(Subject::class, 'subject_id', 'subject_id');
    }
}
