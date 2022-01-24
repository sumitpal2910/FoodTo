<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "foods";

    /**
     * fillable
     */
    protected $fillable = [
        'restaurant_id',
        'menu_id',
        'name',
        'slug',
        'thumbnail',
        'price',
        'description',
        'qty',
        'left_qty',
        'status',
        'veg',
    ];

    /**
     * --------------------------------------
     * ----      SCOPE   ----
     * --------------------------------------
     */
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
     * Toppings
     */
    public function toppings()
    {
        return $this->belongsToMany(Topping::class, 'food_topping');
    }

    /**
     * Timing
     */
    public function timing()
    {
        return $this->hasMany(FoodTiming::class);
    }

    /**
     * Menus
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Restaurant
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
