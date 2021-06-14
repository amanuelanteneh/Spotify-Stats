<?php
require 'vendor/autoload.php';
session_start();

$session = new SpotifyWebAPI\Session(
    '0ec8ef8e321a49429a39d4bc87ca2188',
    'a030de15311a4109a06a2fbc92d89adc',
    'http://spotify-stats-php.herokuapp.com/callback.php'
);

// Request a access token using the code from Spotify

$session->requestAccessToken($_GET['code']);


$accessToken = $session->getAccessToken();
$refreshToken = $session->getRefreshToken();

$_SESSION['accessToken'] = $accessToken; //saving access and refresh tokens in session array
$_SESSION['refreshToken'] = $refreshToken;

$api = new SpotifyWebAPI\SpotifyWebAPI();

$api->setAccessToken($_SESSION['accessToken']);

$_SESSION['user'] = $api->me()->display_name; //set session username




// Send the user to main page 
header('Location: https://spotify-stats-php.herokuapp.com/index.php');
die();

?>