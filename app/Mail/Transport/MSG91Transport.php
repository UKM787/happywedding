<?php

namespace App\Mail\Transport;

use Exception;
use GuzzleHttp\Client;
use Swift_Mime_SimpleMessage;
use Illuminate\Mail\Transport\Transport;

class MSG91Transport extends Transport
{
    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * MSG91Transport constructor.
     *
     * @param GuzzleHttp\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given Message.
     *
     * Recipient/sender data will be retrieved from the Message API.
     *
     * @param Swift_Mime_SimpleMessage $message
     * @param mixed[] $failedRecipients An array of failures by-reference
     *
     * @return int
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        //dd('ss', $message->getTo(), $message->getData(), getenv('MSG91_AUTHKEY'), $message);
        $to = $message->getTo();
        $recipients = array();
        $variables = $message->getData()['data'];
        $template = $message->getData()['template'];
        //dd($variables);
        // Create the recipients array
        foreach ($to as $email) {
            $recipients[] = ['name' => $email, 'email' => array_search($email, $to),];
        }
        //dd($recipients);

        //$key = getenv('MSG91_AUTHKEY');

        try {
            $response = $this->client->post('https://api.msg91.com/api/v5/email/send', [
                'headers' => [
                    'authkey' => '388260A6Kcd8wv5pYU63bd07b3P1',
                    'Accept'     => 'application/json',
                    'Content-Type'     => 'application/json',
                ],
                'json' => [
                    'to' =>
                    $recipients,
                    'from' => [
                        'name' => 'HappyWed',
                        'email' => 'security@happywed.in'
                    ],
                    "domain" => "happywed.in",
                    "mail_type_id" => "1",
                    "template_id" => $template,
                    "variables" => $variables
                ]
            ]);
            //return ['status' => 'success', 'message' => $response->getStatusCode()];
            // dd($response);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // dd('ss', $e->getResponse()->getBody()->getContents());
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            throw new Exception('API call failed: ' . $responseBodyAsString);
            // return ['status' => 'error', 'message' => $response->getStatusCode(), 'error' => $responseBodyAsString];
        }
    }
}
