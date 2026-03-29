<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class publisher extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone_number',
    ];

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
