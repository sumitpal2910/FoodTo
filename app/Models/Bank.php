<?php

namespace App\Models;

use App\Scopes\NameAscScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
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
     * Restaurant Owner
     */
    public function owner()
    {
        return $this->hasMany(RestaurantOwner::class);
    }
}
