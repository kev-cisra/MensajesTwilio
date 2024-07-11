<?php

use Twilio\Rest\Client;

if (! function_exists('mensa_twilio')) {
    function mensa_twilio($from, $mensaje)
    {
        // Your Account SID and Auth Token from twilio.com/console
        // To set up environmental variables, see http://twil.io/secure
        $account_sid = env('TWILIO_ACCOUNT_SID');
        $auth_token = env('TWILIO_AUTH_TOKEN');
        // In production, these should be environment variables. E.g.:
        // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

        // A Twilio number you own with SMS capabilities
        $twilio_number = env('TWILIO_PHONE');

        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            // Where to send a text message (your cell phone?)
            $from,
            array(
                'from' => $twilio_number,
                'body' => $mensaje
            )
        );
    }
}