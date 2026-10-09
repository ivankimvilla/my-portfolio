<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkImage extends Model
{
    protected $fillable = [
        'image_blob',
        'image_mime_type',
        'sort_order',
    ];

    protected $hidden = [
        'image_blob',
    ];
}