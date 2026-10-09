<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $fillable = [
        'file_name',
        'mime_type',
        'file_blob',
    ];

    protected $hidden = [
        'file_blob',
    ];
}