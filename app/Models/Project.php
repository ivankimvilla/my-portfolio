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

        $path = preg_replace('#^/+#', '', $value);

        if (str_starts_with($path, 'public/')) {
            $path = substr($path, 7);
        }

        if (file_exists(public_path($path))) {
            return url($path);
        }

        if (file_exists(public_path('storage/' . $path))) {
            return url('storage/' . $path);
        }

        if (file_exists(public_path('uploads/' . $path))) {
            return url('uploads/' . $path);
        }

        return url($path);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
