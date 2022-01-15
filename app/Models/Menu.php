<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillable
     */
    protected $fillable = [
        'restaurant_id',
        'title',
        'slug',
        'summary',
        'status',
    ];


    /**
     * --------------------------------------
     * ----      RELATIONSHIP    ----
     * --------------------------------------
     */

    /**
     * Restaurant
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    /**
     * Foods
     */
    public function foods()
    {
        return $this->belongsToMany(Food::class, 'menu_food');
    }
}
