<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Mail\Confirmation;


class IntakeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
      dd('laho');
      $normal_users = User::where('type', '=', 0)->get();
      foreach ($normal_users as $user) {
        Mail::to($user->email)->send(new Confirmation($event->intake));
      }
    }
}
