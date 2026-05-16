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
        if (! str_starts_with($path, 'certificates/')) {
            $candidates[] = 'certificates/' . $path;
        }
        if (! str_contains($path, '/')) {
            $candidates[] = 'uploads/certificates/' . $path;
            $candidates[] = 'certificates/' . $path;
        }
        if (str_starts_with($path, 'certificates/')) {
            $candidates[] = 'uploads/' . $path;
        }

        foreach ($candidates as $candidate) {
            if (file_exists(public_path($candidate))) {
                return asset($candidate);
            }
        }

        return asset($path);
    }
}
