<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedWork extends Model
{
    protected $casts = [
        'tag_ids' => 'array',
        'tech_stack_ids' => 'array',
    ];
    protected $guarded = [];
}
