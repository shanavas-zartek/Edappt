<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentdetails extends Model
{
    protected $table = 'student_details';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'grade',
        'school',
        'dob',
        'student_code',
        'parent_id',
        'email',
        'contact_no',
        'address',
        'district',
        'city',
        'state','country','pincode',
        'image',
        'syllabus',
        'best_friend',
        'my_hero',
        'dream',
        'pet_name',
        'age',
        'color',
        'subject',
        'food',
        'teacher',
        'hobby',
        'passtime',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
