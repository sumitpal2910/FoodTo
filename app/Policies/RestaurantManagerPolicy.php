<?php

namespace App\Policies;

use App\Models\Restaurant;
use App\Models\RestaurantManager;
use Illuminate\Auth\Access\HandlesAuthorization;

class RestaurantManagerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the Restaurant can view any models.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Restaurant $restaurant)
    {
        //
    }

    /**
     * Determine whether the Restaurant can view the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\RestaurantManager  $restaurantManager
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Restaurant $restaurant, RestaurantManager $restaurantManager)
    {
        //
    }

    /**
     * Determine whether the Restaurant can create models.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Restaurant $restaurant)
    {
        //
    }

    /**
     * Determine whether the Restaurant can update the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\RestaurantManager  $restaurantManager
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Restaurant $restaurant, RestaurantManager $restaurantManager)
    {
        return $restaurant->id === $restaurantManager->restaurant_id;
    }

    /**
     * Determine whether the Restaurant can delete the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\RestaurantManager  $restaurantManager
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Restaurant $restaurant, RestaurantManager $restaurantManager)
    {
        //
    }

    /**
     * Determine whether the Restaurant can restore the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\RestaurantManager  $restaurantManager
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Restaurant $restaurant, RestaurantManager $restaurantManager)
    {
        //
    }

    /**
     * Determine whether the Restaurant can permanently delete the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\RestaurantManager  $restaurantManager
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Restaurant $restaurant, RestaurantManager $restaurantManager)
    {
        //
    }
}
