<?php

namespace App\Models;

use App\Scopes\NameAscScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'districts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'state_id',
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
     * State
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * City
     */
    public function city()
    {
        return $this->hasMany(City::class);
    }

    /**
     * Restaurants
     */
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
}
