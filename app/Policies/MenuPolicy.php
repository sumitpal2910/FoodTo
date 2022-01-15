<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
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
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Restaurant $restaurant, Menu $menu)
    {
        return $restaurant->id === $menu->restaurant->id;
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
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Restaurant $restaurant, Menu $menu)
    {
        return $restaurant->id === $menu->restaurant->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Restaurant $restaurant, Menu $menu)
    {
        return $restaurant->id === $menu->restaurant->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Restaurant $restaurant, Menu $menu)
    {
        return $restaurant->id === $menu->restaurant->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Restaurant $restaurant, Menu $menu)
    {
        return $restaurant->id === $menu->restaurant->id;
    }
}
