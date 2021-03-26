<?php
session_start();
define('MYDIR','../google-api-php-client--PHP8.0/');
require_once(MYDIR."vendor/autoload.php");

$client = new Google_Client();
$client->setAuthConfig('../credentials.json');

//Unset token from session


// Reset OAuth access token
$client->revokeToken();

if (session_destroy()){
    header('Location:'.'index.php');

}