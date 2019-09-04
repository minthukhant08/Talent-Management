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
                    'Authorization' => 'key=AAAAwOzy9FY:APA91bEDTjBlQ2yob_9u23y9VLBz00Y7OzPkqkSiWUtWARUq23f_hJpEShzg_l0U7BHEueAHoSRGPe2k9NomRe7UbRP3_6QNcliME75DfW3-kPQdb2nGVU53cdIqcvp22fj18zBe497M',
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
