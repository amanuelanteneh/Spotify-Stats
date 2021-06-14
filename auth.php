<?php
//using PHP Spotify API library to make OAuth authorization easier
require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    '0ec8ef8e321a49429a39d4bc87ca2188',
    'a030de15311a4109a06a2fbc92d89adc',
    'https://spotify-stats-php.herokuapp.com/callback.php'
);

$state = $session->generateState();
$options = [
    'scope' => [
        'playlist-read-private',
        'user-read-private',
        'user-top-read',
        'user-read-recently-played',
        'playlist-modify-public',
    ]
];

header('Location: ' . $session->getAuthorizeUrl($options));
die();

?>