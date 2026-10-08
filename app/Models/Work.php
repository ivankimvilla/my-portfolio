<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    public const ROUTE_COLUMNS = [
        'id',
        'title',
        'slug',
        'short_description',
        'full_description',
        'category',
        'tools',
        'project_url',
        'status',
        'sort_order',
        'created_at',
        'updated_at',
    ];

    public const ADMIN_LIST_COLUMNS = [
        'id',
        'title',
        'slug',
        'category',
        'status',
        'sort_order',
        'updated_at',
    ];

    public const PUBLIC_LIST_COLUMNS = [
        'id',
        'title',
        'slug',
        'short_description',
        'category',
        'tools',
        'project_url',
        'sort_order',
        'created_at',
    ];

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'full_description',
        'category',
        'tools',
        'project_url',
        'status',
        'sort_order',
    ];

    protected $hidden = [
        'image_blob',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'tools' => 'array',
        ];
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->newQuery()
            ->select(self::ROUTE_COLUMNS)
            ->where($field ?? $this->getRouteKeyName(), $value)
            ->first();
    }
}
