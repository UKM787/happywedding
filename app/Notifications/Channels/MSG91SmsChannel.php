<?php

namespace App\Notifications\Channels;


use Exception;
use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class MSG91SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        //$key = getenv('MSG91_AUTHKEY');
        //dd($key,'aa');

        $client = new Client();
        // $message = $notification->toMSG91Sms($notifiable)['data'];
        // $flow_id = $notification->toMSG91Sms($notifiable)['flow_id'];
        $data = $notification->toMSG91Sms($notifiable);
        // $failedUsers =
        try {
            $response = $client->post('https://api.msg91.com/api/v5/flow/', [
                'headers' => [
                    'authkey' => '388260A6Kcd8wv5pYU63bd07b3P1',
                    'Content-Type'     => 'application/json',
                ],
                'json' => $data
            ]);
            //dd(json_decode($response->getBody(), true));
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            dd('ss', $e->getResponse()->getBody()->getContents());
            $response = $e->getResponse();
            $failedUsers =
                $responseBodyAsString = $response->getBody()->getContents();
            throw new Exception('API call failed: ' . $responseBodyAsString);
            // return ['status' => 'error', 'message' => $response->getStatusCode(), 'error' => $responseBodyAsString];
        }
    }
}
