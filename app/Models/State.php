<?php

namespace App\Models;

use App\Scopes\NameAscScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'states';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
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
    public function district()
    {
        return $this->hasMany(District::class);
    }

    /**
     * City
     */
    public function city()
    {
        return $this->hasMany(City::class);
    }
}
