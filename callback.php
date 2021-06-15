<?php
require 'vendor/autoload.php';
session_start();

$session = new SpotifyWebAPI\Session(
    'a14f16defc434d5c9574d98fc2bde945',
    'ea84844e954348779762db488e4a4da9',
    'https://spotify-stats-php.herokuapp.com/callback.php'
);

// Request a access token using the code from Spotify

$session->requestAccessToken($_GET['code']);

$accessToken = $session->getAccessToken();
$refreshToken = $session->getRefreshToken();

$_SESSION['accessToken'] = $accessToken; //saving access and refresh tokens in session array
$_SESSION['refreshToken'] = $refreshToken;


try {
    $api = new SpotifyWebAPI\SpotifyWebAPI();
   
    $api->setAccessToken($_SESSION['accessToken']);

    $_SESSION['user'] = $api->me()->display_name;

    header('Location: https://spotify-stats-php.herokuapp.com/callback.php');
    die();
}
catch (SpotifyWebAPI\SpotifyWebAPIException $e) {
    header('Location: https://spotify-stats-php.herokuapp.com/login.php');
}

?>