<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'state_id',
    ];

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
    public function city()
    {
        return $this->hasMany(City::class);
    }
}
