<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'problem_solution',
        'image_url',
        'live_url',
        'github_url',
        'technologies',
        'role',
        'display_order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute($value)
    {
        if (! $value) {
            return null;
        }

        if (preg_match('#^https?://#i', $value)) {
            return $value;
        }

        $path = ltrim($value, '/');
        if (str_starts_with($path, 'public/')) {
            $path = substr($path, 7);
        }

        $candidates = [$path];
        if (! str_starts_with($path, 'storage/')) {
            $candidates[] = 'storage/' . $path;
        }
        if (! str_starts_with($path, 'uploads/')) {
            $candidates[] = 'uploads/' . $path;
        }
        if (! str_contains($path, '/')) {
            $candidates[] = 'uploads/projects/' . $path;
            $candidates[] = 'projects/' . $path;
        }
        if (str_starts_with($path, 'projects/')) {
            $candidates[] = 'uploads/' . $path;
        }

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
