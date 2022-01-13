<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\NameAscScope;

class City extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'state_id',
        'district_id',
        'status',
    ];

    /**
     * Model boot method
     */
    static protected function booted()
    {
        # add global scope - orderby name, asc
        static::addGlobalScope(new NameAscScope);
    }

    /**
     * -----------------------------------
     * ---  RELATIONSHIP  ---
     * -----------------------------------
     */

    /**
     * Districts
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * City
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Restaurants
     */
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
}
