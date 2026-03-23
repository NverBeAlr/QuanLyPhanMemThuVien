<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    protected $fillable = [
        'major_id',
        'name',
        'course_year',
        'description',
    ];

    public function major()
    {
        return $this->belongsTo(major::class);
    }
}
