<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Student extends Authenticatable
{
    protected $fillable = [
        'name',
        'class_id',
        'email',
        'password',
        'phone_number',
        'address',
        'date_of_birth',
        'gender',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function classes()
    {
        return $this->belongsTo(classes::class, 'class_id');
    }
}
