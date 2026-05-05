<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'icon',
        'deliverables',
        'tools',
        'price_range',
        'certificate_path',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'deliverables' => 'array',
        'tools' => 'array',
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
