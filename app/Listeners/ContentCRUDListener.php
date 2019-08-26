<?php

namespace App\Listeners;

use App\Events\ContentCRUDEvent;
use App\Log;
use App\Repositories\Log\LogRepositoryInterface as LogInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContentCRUDListener
{
    public $logInterface;
    private $log;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(LogInterface $logInterface)
    {
        $this->logInterface = $logInterface;
    }

    /**
     * Handle the event.
     *
     * @param  ContentCRUDEvent  $event
     * @return void
     */
    public function handle(ContentCRUDEvent $event)
    {
        $this->log = [
          'admin_id'     => $event->person,
          'action'       => $event->action,
          'category'     => $event->category,
          'descriptions' => $event->descriptions
        ];
        $this->logInterface->store($this->log);
    }
}
