<?php

namespace App\Notifications\Otp;


use Exception;
use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class ResendOtp
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public static function retryOtp($mobile)
    {
        //$key = getenv('MSG91_AUTHKEY');
        //dd($key,'aa', (int)'91'.$mobile);

        $client = new Client();
        // // $failedUsers =
        try {
            $response = $client->get('https://api.msg91.com/api/v5/otp/retry', [
                'headers' => [
                    'Content-Type'     => 'application/JSON',
                ],
                'query' => [
                    'authkey' => '388260A6Kcd8wv5pYU63bd07b3P1',
                    "retrytype" => 'text',
                    "mobile" => '91' . $mobile
                ],
                'stream' => true,
            ]);
            //dd((string)$response->getBody());
            $responseBody = (string) $response->getBody();
            $responseData = json_decode($responseBody, true);
            return $responseData;
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
