<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'id',
        'student_code',
        'full_name',
        'phone_number',
        'email',
        'avatar_img_path'
    ];
    protected $hidden = [
        'password',
        'token',
        'user_created_uuid',
        'soft_deleted',
        'created_at',
        'updated_at'
    ];
}
