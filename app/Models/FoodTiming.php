<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodTiming extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'food_id',
        'day',
        'open',
        'close',
        'status'
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
