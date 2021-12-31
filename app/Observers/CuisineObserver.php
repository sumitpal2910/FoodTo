<?php

namespace App\Observers;

use App\Models\Cuisine;

class CuisineObserver
{
    /**
     * Handle the Cuisine "created" event.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return void
     */
    public function created(Cuisine $cuisine)
    {
        //
    }

    /**
     * Handle the Cuisine "updated" event.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return void
     */
    public function updated(Cuisine $cuisine)
    {
        //
    }

    /**
     * Handle the Cuisine "deleted" event.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return void
     */
    public function deleted(Cuisine $cuisine)
    {
        //
    }

    /**
     * Handle the Cuisine "restored" event.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return void
     */
    public function restoring(Cuisine $cuisine)
    {
        $cuisine->status = 1;
        $cuisine->save();
    }

    /**
     * Handle the Cuisine "restored" event.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return void
     */
    public function restored(Cuisine $cuisine)
    {
        //
    }

    /**
     * Handle the Cuisine "force deleted" event.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return void
     */
    public function forceDeleted(Cuisine $cuisine)
    {
        //
    }
}
