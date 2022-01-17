<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuisine extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'status',
    ];

    /**
     * ------------------------------------
     * ----     Relationship ----
     * ------------------------------------
     */
    /**
     * Restaurant
     */
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_cuisine');
    }
}
