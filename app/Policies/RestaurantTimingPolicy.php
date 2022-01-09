<?php

namespace App\Policies;

use App\Models\Restaurant;
use App\Models\RestaurantTiming;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RestaurantTimingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RestaurantTiming  $restaurantTiming
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, RestaurantTiming $restaurantTiming)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RestaurantTiming  $restaurantTiming
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Restaurant $user, RestaurantTiming $restaurantTiming)
    {
        return $user->id === $restaurantTiming->restaurant_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RestaurantTiming  $restaurantTiming
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RestaurantTiming $restaurantTiming)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RestaurantTiming  $restaurantTiming
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, RestaurantTiming $restaurantTiming)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RestaurantTiming  $restaurantTiming
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, RestaurantTiming $restaurantTiming)
    {
        //
    }
}
