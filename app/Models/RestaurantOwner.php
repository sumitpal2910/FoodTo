<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantOwner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'bank_id',
        'name',
        'phone',
        'alt_phone',
        'account_no',
        'ifsc',
        'passbook',
    ];


    /**
     * Restaurant
     */
    public function restaurant()
    {
        return $this->hasOne(Restaurant::class);
    }

    /**
     * Bank
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
