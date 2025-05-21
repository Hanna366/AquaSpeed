<?php
require_once 'vendor/autoload.php';
session_start();

$client = new Google_Client();
$client->setClientId('821851231041-ub84l3bq5gbtk7e41to8dvdfensgcj3j.apps.googleusercontent.com');
$client->setClientSecret('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T');
$client->setRedirectUri('http://localhost/AquaSpeed/google_callback.php');
$client->addScope("email");
$client->addScope("profile");
$client->setPrompt('select_account');


$authUrl = $client->createAuthUrl();
header('Location: ' . $authUrl);
exit();
