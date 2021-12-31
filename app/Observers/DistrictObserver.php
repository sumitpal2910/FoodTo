<?php

namespace App\Observers;

use App\Models\District;

class DistrictObserver
{
    /**
     * Handle the District "created" event.
     *
     * @param  \App\Models\District  $district
     * @return void
     */
    public function created(District $district)
    {
        //
    }

    /**
     * Handle the District "updated" event.
     *
     * @param  \App\Models\District  $district
     * @return void
     */
    public function updating(District $district)
    {
        //
    }

    /**
     * Handle the District "updated" event.
     *
     * @param  \App\Models\District  $district
     * @return void
     */
    public function updated(District $district)
    {
        if ($district->status === 1) {
            $district->state()->update(['status' => 1]);
            $district->city()->update(['status' => 1]);
            $district->restaurants()->update(['status' => 1]);
        } else {
            $district->city()->update(['status' => 0]);
            $district->restaurants()->update(['status' => 2]);
        }
    }

    /**
     * Handle the District "deleted" event.
     *
     * @param  \App\Models\District  $district
     * @return void
     */
    public function deleting(District $district)
    {
        $district->city()->delete();
        $district->restaurants()->delete();
    }

    /**
     * Handle the District "deleted" event.
     *
     * @param  \App\Models\District  $district
     * @return void
     */
    public function deleted(District $district)
    {
        //
    }

    /**
     * Handle the District "restored" event.
     *
     * @param  \App\Models\District  $district
     * @return void
     */
    public function restoring(District $district)
    {
        # restore state
        $district->state()->restore();
    }

    /**
     * Handle the District "restored" event.
     *
     * @param  \App\Models\District  $district
     * @return void
     */
    public function restored(District $district)
    {
        //
    }

    /**
     * Handle the District "force deleted" event.
     *
     * @param  \App\Models\District  $district
     * @return void
     */
    public function forceDeleted(District $district)
    {
        //
    }
}
