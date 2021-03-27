<?php

session_start();
define('MYDIR','../google-api-php-client--PHP8.0/');
require_once(MYDIR."vendor/autoload.php");

$redirect_uri = 'https://wt123.fei.stuba.sk/pribulikZadanie03/signGoogle.php';

$client = new Google_Client();
$client->setAuthConfig('../credentials.json');
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");

$service = new Google_Service_Oauth2($client);

if(isset($_GET['code'])){
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);
    $_SESSION['upload_token'] = $token;

    // redirect back to the example
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

// set the access token as part of the client
if (!empty($_SESSION['upload_token'])) {
    $client->setAccessToken($_SESSION['upload_token']);
    if ($client->isAccessTokenExpired()) {
        unset($_SESSION['upload_token']);
    }
} else {
    $authUrl = $client->createAuthUrl();
}

if ($client->getAccessToken()) {
    //Get user profile data from google
    $UserProfile = $service->userinfo->get();
    var_dump($client->getAccessToken());
    if(!empty($UserProfile)){
        include_once ("connect.php");
        $conn = pokusLogin();
        vlozenieLoginu($conn,$UserProfile['id'],"google");

        $_SESSION['nickname']= $UserProfile['given_name'].' '.$UserProfile['family_name'];
        $_SESSION['typ'] = "google";
        $_SESSION['id']=$UserProfile['id'];
        header('Location:'.'index.php');


    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
       echo '<div>'.$output.'</div>';
    }
} else {
    $authUrl = $client->createAuthUrl();
    header('Location:'. filter_var($authUrl, FILTER_SANITIZE_URL));
}
?>



