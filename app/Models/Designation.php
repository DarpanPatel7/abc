<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'status',
        'deleted_at',
    ];

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    /**
     * get status class
     *
     * @var array<string, string>
     */
    public function getbadgeStatusAttribute()
    {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 'badge bg-label-danger';
            case self::STATUS_APPROVED:
                return 'badge bg-label-success';
            default:
                return '';
        }
    }
}
