<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;

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
        'current_team_id',
        'designation_id',
        'employee_no',
        'name',
        'email',
        'email_verified_at',
        'two_factor_confirmed_at',
        'current_address',
        'permanent_address',
        'date_of_birth',
        'joining_date',
        'profile_photo',
        'identity_proof',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        // 'profile_photo_url',
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

    /**
     * get profile photo path.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function getProfilePhotoPathAttribute($value)
    {
        if(!empty($this->profile_photo) && Storage::disk('uploads')->exists($this->profile_photo)){
            return Storage::disk('uploads')->url($this->profile_photo);
        }else{
            return Config('global.default_pfp');
        }
    }

    /**
     * get profile photo path.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function getIdentityProofPathAttribute($value)
    {
        if(!empty($this->identity_proof) && Storage::disk('uploads')->exists($this->identity_proof)){
            return Storage::disk('uploads')->url($this->identity_proof);
        }else{
            return '';
        }
    }

    /**
     * Scope a query to get data by company.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeGetSuperAdmin($query)
    {
        $query->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')->join('roles', 'model_has_roles.role_id', '=', 'roles.id')->where('roles.name', 'Super Admin');
    }

    /**
     * get designation relation
     *
     * @return array<int, string>
     */
    public function Designation()
    {
        return $this->hasOne(Designation::class, 'id', 'designation_id');
    }

    /**
     * set default date format
     *
     * @return array<int, string>
     */
    public function getDobAttribute()
    {
        if(!empty($this->date_of_birth)){
            return \Carbon\Carbon::parse($this->date_of_birth)->format(config('global.date_format'));
        }else{
            return '';
        }
    }

    /**
     * set default date format
     *
     * @return array<int, string>
     */
    public function getJdAttribute()
    {
        if(!empty($this->joining_date)){
            return \Carbon\Carbon::parse($this->joining_date)->format(config('global.date_format'));
        }else{
            return '';
        }
    }

    /**
     * Scope a query to get data for users with Not Super Admin.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeNoSuperAdminUser($query)
    {
        $query->where(function ($qu) {
            $qu->whereDoesntHave('roles');
            $qu->orwhereHas("roles", function ($q) { $q->where("name", '!=', "Super Admin"); });
        });
    }
}
