<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    protected $fillable = [
        'name',
        'author_id',
        'publisher_id',
        'category_id',
        'total_quantity',
        'available_quantity',
        'year_published',
        'status',
        'description',
    ];

    public function author()
    {
        return $this->belongsTo(author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(publisher::class);
    }

    public function category()
    {
        return $this->belongsTo(category::class);
    }
}
