<?php
if (!function_exists('googleAuth')) {
    function googleAuth() {
        require_once 'vendor/autoload.php';
        $clientID = $_ENV['GOOGLE_CLIENT_ID'];
        $clientSecret = $_ENV['GOOGLE_CLIENT_SECRET'];
        $redirectUri = base_url('login/google');

        // create Client Request to access Google API
        $client = new Google_Client();
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);

        $client->addScope("email");
        $client->addScope("profile");

        return $client;
    }
}
