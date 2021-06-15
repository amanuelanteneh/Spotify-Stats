<?php
require 'vendor/autoload.php';
session_start();

$session = new SpotifyWebAPI\Session(
    '0ec8ef8e321a49429a39d4bc87ca2188',
    'a030de15311a4109a06a2fbc92d89adc',
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

    header('Location: https://spotify-stats-php.herokuapp.com/index.php');
    die();
}
catch (SpotifyWebAPI\SpotifyWebAPIException $e) {
    header('Location: https://spotify-stats-php.herokuapp.com/login.php');
}

?>