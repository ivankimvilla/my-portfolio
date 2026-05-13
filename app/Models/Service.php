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

    public function getCertificateUrlAttribute()
    {
        $value = $this->certificate_path;

        if (! $value) {
            return null;
        }

        if (preg_match('#^https?://#i', $value)) {
            return $value;
        }

        $path = ltrim($value, '/');

        $candidates = [
            $path,
            'storage/' . $path,
            'certificates/' . $path,
        ];

        foreach ($candidates as $candidate) {
            if (file_exists(public_path($candidate))) {
                return asset($candidate);
            }
        }

        return asset($path);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
