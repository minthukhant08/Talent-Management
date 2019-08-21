<?php

namespace App\Providers\App\Listeners;

use App\Providers\App\Events\IntakeAvailableEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IntakeListener
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
     * @param  IntakeAvailableEvent  $event
     * @return void
     */
    public function handle(IntakeAvailableEvent $event)
    {
        //
    }
}
