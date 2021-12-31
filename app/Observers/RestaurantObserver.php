<?php

namespace App\Observers;

use App\Models\Restaurant;

class RestaurantObserver
{
    /**
     * Handle the Restaurant "created" event.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return void
     */
    public function created(Restaurant $restaurant)
    {
        //
    }

    /**
     * Handle the Restaurant "updated" event.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return void
     */
    public function updated(Restaurant $restaurant)
    {
        //   
    }

    /**
     * Handle the Restaurant "deleted" event.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return void
     */
    public function deleting(Restaurant $restaurant)
    {
        $restaurant->owner()->delete();
        $restaurant->manager()->delete();
        $restaurant->timing()->delete();
    }

    /**
     * Handle the Restaurant "deleted" event.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return void
     */
    public function deleted(Restaurant $restaurant)
    {
        //
    }

    /**
     * Handle the Restaurant "restored" event.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return void
     */
    public function restoring(Restaurant $restaurant)
    {
        $restaurant->owner()->restore();
        $restaurant->manager()->restore();
        $restaurant->timing()->restore();
    }

    /**
     * Handle the Restaurant "restored" event.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return void
     */
    public function restored(Restaurant $restaurant)
    {
        //
    }

    /**
     * Handle the Restaurant "force deleted" event.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return void
     */
    public function forceDeleted(Restaurant $restaurant)
    {
        //
    }
}
