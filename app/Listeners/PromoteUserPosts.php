<?php

namespace App\Listeners;

use App\Events\PlanWasPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PromoteUserPosts
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PlanWasPurchased  $event
     * @return void
     */
    public function handle(PlanWasPurchased $event)
    {
        dd($event->order->user->posts);
    }
}
