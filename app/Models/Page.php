<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'type',
        'is_published',
        'order'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'order' => 'integer'
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = \Str::slug($value);
    }
}
