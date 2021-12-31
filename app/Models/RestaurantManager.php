<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantManager extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'restaurant_managers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'restaurant_id',
        'name',
        'phone',
        'alt_phone',
    ];


    /**
     * -------------------------------------------
     *  ----    Relationship ----
     * -------------------------------------------
     */


    /**
     * Restaurant
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
