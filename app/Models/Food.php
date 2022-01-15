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
        'name',
        'slug',
        'thumbnail',
        'price',
        'description',
        'qty',
        'status',
        'type',
    ];


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
        return $this->hasMany(Topping::class);
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
        return $this->belongsToMany(Menu::class, 'menu_food');
    }
}
