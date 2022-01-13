<?php

namespace App\Policies;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Auth\Access\HandlesAuthorization;

class FoodPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Restaurant $restaurant)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Restaurant $restaurant, Food $food)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Restaurant $restaurant)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Restaurant $restaurant, Food $food)
    {
        return $restaurant->id = $food->restaurant_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Restaurant $restaurant, Food $food)
    {
        return $restaurant->id = $food->restaurant_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Restaurant $restaurant, Food $food)
    {
        return $restaurant->id = $food->restaurant_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Restaurant $restaurant, Food $food)
    {
        return $restaurant->id = $food->restaurant_id;
    }
}
