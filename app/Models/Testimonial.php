<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'client_name',
        'client_company',
        'client_title',
        'client_image',
        'content',
        'rating',
        'project_url',
        'display_order',
        'is_featured',
        'is_active',
        'is_approved',
        'admin_notes',
        'ip_address',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'is_approved' => 'boolean',
    ];

    public function getClientImageAttribute($value)
    {
        if (! $value) {
            return null;
        }

        if (preg_match('/^https?:\/\//', $value)) {
            return $value;
        }

        return asset(ltrim($value, '/'));
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
