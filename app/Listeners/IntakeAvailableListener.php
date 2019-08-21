<?php

namespace App\Listeners;

use App\Events\IntakeAvailableEvent;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Intake;

class IntakeAvailableListener implements ShouldQueue
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
        Mail::to($event->user->email)->send(new Intake($event->intake->form_link, $event->user->name));
    }
}
