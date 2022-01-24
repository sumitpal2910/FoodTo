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
        'full_address',
        'landmark',
        'area',
        'lat',
        'long',
        'pincode',
        'status',
        'veg',
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
     * 0 - pending listing
     * 1 - listed
     * 2 - delisted
     * 3 - reject listing
     */

    /**
     * ------------------------
     * ---  QUERY SCOPE ---
     * ------------------------
     */
    /**
     * Active
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    /**
     * Pending Listed
     */
    public function scopePending($query)
    {
        return $query->where('status', 0);
    }

    /**
     * Delisted
     */
    public function scopeDelisted($query)
    {
        return $query->where('status', 2);
    }

    /**
     * Rejected
     */
    public function scopeRejectd($query)
    {
        return $query->where('status', 2);
    }
    /**
     * menu that has foods
     */
    public function scopeThatHasMenuFoods($query)
    {
        return $query->has('menus', '>=', 1)->has('menus.foods', '>=', 1);
    }


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
    public function timings()
    {
        return $this->hasMany(RestaurantTiming::class);
    }

    /**
     * Timing
     */
    public function todayTiming()
    {
        $day = date('l');
        return $this->hasOne(RestaurantTiming::class, 'restaurant_id', 'id')->where('day', $day);
    }



    /**
     * Food
     */
    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    /**
     * Toppings
     */
    public function toppings()
    {
        return $this->hasMany(Topping::class);
    }

    /**
     * Menu
     */
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
