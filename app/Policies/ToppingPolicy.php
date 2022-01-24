<?php

namespace App\Policies;

use App\Models\Topping;
use App\Models\Restaurant;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ToppingPolicy
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
     * @param  \App\Models\Topping  $topping
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Restaurant $restaurant, Topping $topping)
    {
        return  $restaurant->id = $topping->restaurant_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Restaurant $restaurant)
    {
        //return Auth::guard('restaurant')->id() === $restaurant->id;
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\Topping  $topping
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Restaurant $restaurant, Topping $topping)
    {
        return  $restaurant->id === $topping->restaurant_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\Topping  $topping
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Restaurant $restaurant, Topping $topping)
    {
        return  $restaurant->id === $topping->restaurant_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\Topping  $topping
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Restaurant $restaurant, Topping $topping)
    {
        return  $restaurant->id === $topping->restaurant_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\Topping  $topping
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Restaurant $restaurant, Topping $topping)
    {
        return  $restaurant->id === $topping->restaurant_id;
    }
}
