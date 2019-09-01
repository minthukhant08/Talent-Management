<?php

namespace App\Listeners;

use App\Events\IntakeAvailableEvent;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Intake;
use App\Repositories\User\UserRepositoryInterface as UserInterface;

class IntakeAvailableListener
{
    public $userInterface;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     * Handle the event.
     *
     * @param  IntakeAvailableEvent  $event
     * @return void
     */
    public function handle(IntakeAvailableEvent $event)
    {
        $users = $this->userInterface->getNormalUsers();
        // dd(count($users));
        foreach ($users as $user) {
          try {
            Mail::to($user->email)->send(new Intake($event->intake->form_link, $user->name));
          } catch (\Exception $e) {

          }
        }
    }
}
