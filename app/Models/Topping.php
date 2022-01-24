<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Topping extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * fillable
     */
    protected $fillable = [
        'restaurant_id',
        'name',
        'price',
        'qty',
        'left_qty',
        'status',
        'veg',
    ];




    /**
     * -----------------------------------
     * ---  SCOPRE  ---
     * -----------------------------------
     */

    public function scopeRestaurant($query)
    {
        return $query->where('restaurant_id', Auth::guard('restaurant')->id());
    }

    /**
     * Active status -1
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * -----------------------------------
     * ---  RELATIONSHIP  ---
     * -----------------------------------
     */

    /**
     * Food
     */
    public function food()
    {
        return $this->belongsToMany(Food::class, 'food_topping');
    }

    /**
     * Restaurant
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * Foodds
     */
    public function foods()
    {
        return $this->belongsToMany(Food::class, 'food_topping');
    }
}
