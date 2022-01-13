<?php

namespace App\Policies;

use App\Models\FoodTiming;
use App\Models\Restaurant;
use Illuminate\Auth\Access\HandlesAuthorization;

class FoodTimingPolicy
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
     * @param  \App\Models\Restaurant  $Restaurant
     * @param  \App\Models\FoodTiming  $foodTiming
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Restaurant $restaurant, FoodTiming $foodTiming)
    {
        return $restaurant->id === $foodTiming->food->restaurant_id;
    }

    /**
     * Determine whether the Restaurant can create models.
     *
     * @param  \App\Models\Restaurant  $Restaurant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Restaurant $restaurant)
    {
        //
    }

    /**
     * Determine whether the Restaurant can update the model.
     *
     * @param  \App\Models\Restaurant  $Restaurant
     * @param  \App\Models\FoodTiming  $foodTiming
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Restaurant $restaurant, FoodTiming $foodTiming)
    {
        return $restaurant->id === $foodTiming->food->restaurant_id;
    }

    /**
     * Determine whether the Restaurant can delete the model.
     *
     * @param  \App\Models\Restaurant  $Restaurant
     * @param  \App\Models\FoodTiming  $foodTiming
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Restaurant $restaurant, FoodTiming $foodTiming)
    {
        return $restaurant->id === $foodTiming->food->restaurant_id;
    }

    /**
     * Determine whether the Restaurant can restore the model.
     *
     * @param  \App\Models\Restaurant  $Restaurant
     * @param  \App\Models\FoodTiming  $foodTiming
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Restaurant $restaurant, FoodTiming $foodTiming)
    {
        return $restaurant->id === $foodTiming->food->restaurant_id;
    }

    /**
     * Determine whether the Restaurant can permanently delete the model.
     *
     * @param  \App\Models\Restaurant  $Restaurant
     * @param  \App\Models\FoodTiming  $foodTiming
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Restaurant $restaurant, FoodTiming $foodTiming)
    {
        return $restaurant->id === $foodTiming->food->restaurant_id;
    }
}
