<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const STATUS_INACTIVE_TEXT = 'Inactive';
    const STATUS_ACTIVE_TEXT = 'Active';

    const CORE_STATUS_ARRAY = [
        self::STATUS_INACTIVE => self::STATUS_INACTIVE_TEXT,
        self::STATUS_ACTIVE => self::STATUS_ACTIVE_TEXT,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'sortcode',
        'status',
    ];

    /**
     * Scope a query to only include customer sources.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    /**
     * get status string
     *
     * @var array<string, string>
     */
    public function getstringStatusAttribute()
    {
        return self::CORE_STATUS_ARRAY[$this->status] ?? '';
    }

    /**
     * get status class
     *
     * @var array<string, string>
     */
    public function getbadgeStatusAttribute()
    {
        switch ($this->status) {
            case self::STATUS_INACTIVE:
                return 'badge bg-label-danger';
            case self::STATUS_ACTIVE:
                return 'badge bg-label-success';
            default:
                return '';
        }
    }
}
