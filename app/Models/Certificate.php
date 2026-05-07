<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'title',
        'issuer',
        'issue_date',
        'description',
        'certificate_path',
        'is_active',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'is_active' => 'boolean',
    ];
}
