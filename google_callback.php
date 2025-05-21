<?php
require_once 'vendor/autoload.php';
session_start();

$client = new Google_Client();
$client->setClientId('821851231041-ub84l3bq5gbtk7e41to8dvdfensgcj3j.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/AquaSpeed/google_callback.php');
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);
        $oauth = new Google_Service_Oauth2($client);
        $userInfo = $oauth->userinfo->get();

        // Store info in session
        $_SESSION['user_id'] = $userInfo->id;
        $_SESSION['name'] = $userInfo->name;
        $_SESSION['email'] = $userInfo->email;
        $_SESSION['picture'] = $userInfo->picture;

        header('Location: home.php'); // or wherever you want
        exit();
    } else {
        echo "Error fetching token: " . $token['error'];
    }
} else {
    echo "Authorization code not found.";
}
