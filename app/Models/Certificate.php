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
}
