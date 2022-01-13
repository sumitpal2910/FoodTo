<?php

namespace App\Observers;

use App\Models\Food;

class FoodObserver
{
    /**
     * Handle the Food "created" event.
     *
     * @param  \App\Models\Food  $food
     * @return void
     */
    public function created(Food $food)
    {
        //
    }

    /**
     * Handle the Food "updated" event.
     *
     * @param  \App\Models\Food  $food
     * @return void
     */
    public function updating(Food $food)
    {
        //
    }
    /**
     * Handle the Food "updated" event.
     *
     * @param  \App\Models\Food  $food
     * @return void
     */
    public function updated(Food $food)
    {
        if ($food->trashed()) $food->restore();
        $food->status = 1;
    }

    /**
     * Handle the Food "deleted" event.
     *
     * @param  \App\Models\Food  $food
     * @return void
     */
    public function deleting(Food $food)
    {
        $food->toppings()->delete();
        $food->timing()->delete();
    }
    /**
     * Handle the Food "deleted" event.
     *
     * @param  \App\Models\Food  $food
     * @return void
     */
    public function deleted(Food $food)
    {
        //
    }

    /**
     * Handle the Food "restored" event.
     *
     * @param  \App\Models\Food  $food
     * @return void
     */
    public function restoring(Food $food)
    {
        $food->status = 1;

        $food->toppings()->restore();
        $food->timing()->restore();
    }
    /**
     * Handle the Food "restored" event.
     *
     * @param  \App\Models\Food  $food
     * @return void
     */
    public function restored(Food $food)
    {
        //
    }

    /**
     * Handle the Food "force deleted" event.
     *
     * @param  \App\Models\Food  $food
     * @return void
     */
    public function forceDeleted(Food $food)
    {
        $food->toppings()->forceDelete();
        $food->timing()->forceDelete();
    }
}
