<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminMenu extends Model
{
    use HasFactory, SoftDeletes;

    // Status Constants
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;

    // Menu Type Constants
    public const MENU_TYPE_PARENT_MENU = 0;
    public const MENU_TYPE_CHILD_MENU = 1;
    public const MENU_TYPE_INTERNAL_LINK = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu_name',
        'url',
        'menu_type',
        'parent_id',
        'menu_rank',
        'status'
    ];

    /**
     * Get status text mapping.
     *
     * @return array
     */
    public static function getStatus(): array
    {
        return [
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_ACTIVE => 'Active',
        ];
    }

    /**
     * Get menu type text mapping.
     *
     * @return array
     */
    public static function getmenuType(): array
    {
        return [
            self::MENU_TYPE_PARENT_MENU => 'Parent Menu',
            self::MENU_TYPE_CHILD_MENU => 'Child Menu',
            self::MENU_TYPE_INTERNAL_LINK => 'Internal Link',
        ];
    }

    /**
     * Scope a query to only include active menus.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('status', self::STATUS_ACTIVE);
    }

    /**
     * Get the status text attribute.
     *
     * @return string
     */
    public function getstringStatusAttribute(): string
    {
        return self::getStatus()[$this->status] ?? 'Unknown';
    }

    /**
     * Get the status badge class attribute.
     *
     * @return string
     */
    public function getbadgeStatusAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_INACTIVE => 'badge bg-label-danger',
            self::STATUS_ACTIVE => 'badge bg-label-success',
            default => 'badge bg-label-default',
        };
    }
}
