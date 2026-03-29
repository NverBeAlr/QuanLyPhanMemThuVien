<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
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

    public function classes()
    {
        return $this->belongsTo(classes::class, 'class_id');
    }
}
