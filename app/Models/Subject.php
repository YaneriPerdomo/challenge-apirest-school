<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $primaryKey = 'subject_id';

    protected $fillable = [
        'name',
        'descripcion',
        'slug'
    ];

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'subject_id');
    }

    public function qualifications(){
        return $this->hasMany(Qualification::class, 'subject_id');

    }
}
