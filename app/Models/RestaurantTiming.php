<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantTiming extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'restaurant_id',
        'day',
        'open',
        'close',
        'status'
    ];

    /**
     * --------------------------------------
     *  ----    Relationship    ----
     * --------------------------------------
     */

    /**
     * restaurant
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
