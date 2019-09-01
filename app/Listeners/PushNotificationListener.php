<?php

namespace App\Listeners;

use App\Events\PushNotificationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use GuzzleHttp;

class PushNotificationListener
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

    public function sendNoti($message)
    {
      $client = new \GuzzleHttp\Client();
      $url = "https://fcm.googleapis.com/fcm/send";
      $client = new GuzzleHttp\Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'key=AAAAjtjYYAY:APA91bFCOZ0NBhq4Zujx2NwFgWbTzTOMmXS6LRJhGC3GWTm6sY8Zndze8bT5SViM3uRdH1d9gWXhwIHpmjlHlN6EeXz3ds2TbxPSxG7miS27M2-ZIW0YVMM0qH0bhRjJd01fu9p-MPMP',
                ]
            ]);
      $response = $client->post('https://fcm.googleapis.com/fcm/send',
                      ['body' => json_encode($message)]
                  );
    }
    /**
     * Handle the event.
     *
     * @param  PushNotificationEvent  $event
     * @return void
     */
    public function handle(PushNotificationEvent $event)
    {
        $this->sendNoti($event->message);
    }
}
