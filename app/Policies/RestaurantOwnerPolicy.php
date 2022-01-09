<?php

namespace App\Policies;

use App\Models\Restaurant;
use App\Models\RestaurantOwner;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class RestaurantOwnerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the Restaurant can view any models.
     *
     * @param  \App\Models\Restaurant  $Restaurant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Restaurant $Restaurant)
    {
        //
    }

    /**
     * Determine whether the Restaurant can view the model.
     *
     * @param  \App\Models\Restaurant  $Restaurant
     * @param  \App\Models\RestaurantOwner  $restaurantOwner
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Restaurant $Restaurant, RestaurantOwner $restaurantOwner)
    {
        //
    }

    /**
     * Determine whether the Restaurant can create models.
     *
     * @param  \App\Models\Restaurant  $Restaurant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Restaurant $Restaurant)
    {
        //
    }

    /**
     * Determine whether the Restaurant can update the model.
     *
     * @param  \App\Models\Restaurant  $Restaurant
     * @param  \App\Models\RestaurantOwner  $restaurantOwner
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Restaurant $restaurant, RestaurantOwner $restaurantOwner)
    {
        return $restaurant->owner_id === $restaurantOwner->id;
    }

    /**
     * Determine whether the Restaurant can delete the model.
     *
     * @param  \App\Models\Restaurant  $Restaurant
     * @param  \App\Models\RestaurantOwner  $restaurantOwner
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Restaurant $Restaurant, RestaurantOwner $restaurantOwner)
    {
        //
    }

    /**
     * Determine whether the Restaurant can restore the model.
     *
     * @param  \App\Models\Restaurant  $Restaurant
     * @param  \App\Models\RestaurantOwner  $restaurantOwner
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Restaurant $Restaurant, RestaurantOwner $restaurantOwner)
    {
        //
    }

    /**
     * Determine whether the Restaurant can permanently delete the model.
     *
     * @param  \App\Models\Restaurant  $Restaurant
     * @param  \App\Models\RestaurantOwner  $restaurantOwner
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Restaurant $Restaurant, RestaurantOwner $restaurantOwner)
    {
        //
    }
}
