<?php

session_start();
//odhlasenie pre GOOGLE
define('MYDIR','../google-api-php-client--PHP8.0/');
require_once(MYDIR."vendor/autoload.php");

$client = new Google_Client();
$client->setAuthConfig('../credentials.json');

$accesstoken=$_SESSION['upload_token'];
//Unset token from session
unset($_SESSION['upload_token']);


// Reset OAuth access token
$client->revokeToken($accesstoken);

//odhlasenie pre vsetko
if (session_destroy()){
    header('Location:'.'index.php');

}