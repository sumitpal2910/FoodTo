<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topping extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * fillable
     */
    protected $fillable = [
        'food_id',
        'name',
        'price',
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
     * Food
     */
    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
