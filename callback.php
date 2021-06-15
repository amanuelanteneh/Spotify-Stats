<?php
require 'vendor/autoload.php';
//session_start();

$session = new SpotifyWebAPI\Session(
    '0ec8ef8e321a49429a39d4bc87ca2188',
    'a030de15311a4109a06a2fbc92d89adc',
    'https://spotify-stats-php.herokuapp.com/callback.php'
);

// Request a access token using the code from Spotify

$session->requestAccessToken($_GET['code']);


$accessToken = $session->getAccessToken();
$refreshToken = $session->getRefreshToken();

//$_COOKIE['accessToken'] = $accessToken; //saving access and refresh tokens in session array
//$_COOKIE['refreshToken'] = $refreshToken;

setcookie('accessToken', $accessToken, time() + (86400 * 30));
setcookie('refreshToken', $refreshToken, time() + (86400 * 30));

//$session->refreshAccessToken($refreshToken);

$api = new SpotifyWebAPI\SpotifyWebAPI();

$api->setAccessToken($_COOKIE['accessToken']);


setcookie("user", $api->me()->display_name, time() + (86400 * 10));
//$_COOKIE['user'] = "temp";// //set session username


// Send the user to main page 
header('Location: https://spotify-stats-php.herokuapp.com/index.php');
die();

?>