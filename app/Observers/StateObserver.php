<?php

namespace App\Observers;

use App\Models\State;

class StateObserver
{
    /**
     * Handle the State "created" event.
     *
     * @param  \App\Models\State  $state
     * @return void
     */
    public function created(State $state)
    {
        //
    }

    /**
     * Handle the State "updated" event.
     *
     * @param  \App\Models\State  $state
     * @return void
     */
    public function updating(State $state)
    {
    }

    /**
     * Handle the State "updated" event.
     *
     * @param  \App\Models\State  $state
     * @return void
     */
    public function updated(State $state)
    {
        if ($state->status === 1) {
            $state->district()->update(['status' => 1]);
            $state->city()->update(['status' => 1]);
        } else if ($state->status === 0) {
            $state->district()->update(['status' => 0]);
            $state->city()->update(['status' => 0]);
        }
    }

    /**
     * Handle the State "deleted" event.
     *
     * @param  \App\Models\State  $state
     * @return void
     */
    public function deleting(State $state)
    {
        # delete district
        $state->district()->delete();

        $state->city()->delete();
    }

    /**
     * Handle the State "deleted" event.
     *
     * @param  \App\Models\State  $state
     * @return void
     */
    public function deleted(State $state)
    {
        //
    }

    /**
     * Handle the State "restoring" event.
     *
     * @param  \App\Models\State  $state
     * @return void
     */
    public function restoring(State $state)
    {
        # restore district
        $state->district()->restore();
        $state->city()->restore();
    }

    /**
     * Handle the State "restored" event.
     *
     * @param  \App\Models\State  $state
     * @return void
     */
    public function restored(State $state)
    {
        //
    }

    /**
     * Handle the State "force deleted" event.
     *
     * @param  \App\Models\State  $state
     * @return void
     */
    public function forceDeleted(State $state)
    {
        //
    }
}
