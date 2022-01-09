<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Restaurant extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * Restaurant Guard
     */
    protected $guard = "restaurant";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'owner_id',
        'state_id',
        'district_id',
        'city_id',
        'slug',
        'cuisine',
        'phone',
        'alt_phone',
        'gst_no',
        'trade_name',
        'license_no',
        'fssai_no',
        'kyc',
        'thumbnail',
        'bg_image',
        'fssai_image',
        'license_image',
        'menu',
        'address',
        'latitude',
        'longitude',
        'pincode',
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
     * -----------------------------------
     * ---  RELATIONSHIP  ---
     * -----------------------------------
     */

    /**
     * State
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * District
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * City
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Owner
     */
    public function owner()
    {
        return $this->belongsTo(RestaurantOwner::class);
    }
    /**
     * Manager
     */
    public function manager()
    {
        return $this->hasOne(RestaurantManager::class);
    }

    /**
     * Timing
     */
    public function timing()
    {
        return $this->hasMany(RestaurantTiming::class);
    }
}
