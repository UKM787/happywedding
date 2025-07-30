<?php

namespace App\Notifications\Channels;


use Exception;
use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class MSG91EmailChannel
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
        $key = getenv('MSG91_AUTHKEY');
        //dd($key, 'aa', config('mail.mailer.msg91.client_key'));

        $client = new Client();
        $message = $notification->toMSG91($notifiable)['data'];
        $template = $notification->toMSG91($notifiable)['template'];
        //dd($message);
        // $failedUsers =
        try {
            $response = $client->post('https://api.msg91.com/api/v5/email/send', [
                'headers' => [
                    'authkey' =>   '388260A6Kcd8wv5pYU63bd07b3P1',
                    'Accept'     => 'application/json',
                    'Content-Type'     => 'application/json',
                ],
                'json' => [
                    'to' => [
                        [
                            'name' => $notifiable->name,
                            'email' => $notifiable->email
                        ],
                    ],
                    'from' => [
                        'name' => 'HappyWed',
                        'email' => 'support@happywed.in'
                    ],
                    "domain" => "happywed.in",
                    "mail_type_id" => "1",
                    "template_id" => $template,
                    "variables" => $message
                ]
            ]);
            //dd(json_decode($response->getBody(), true));
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            //dd('ss', $e->getResponse()->getBody()->getContents());
            $response = $e->getResponse();
            $failedUsers =
                $responseBodyAsString = $response->getBody()->getContents();
            throw new Exception('API call failed: ' . $responseBodyAsString);
            // return ['status' => 'error', 'message' => $response->getStatusCode(), 'error' => $responseBodyAsString];
        }
    }
}
