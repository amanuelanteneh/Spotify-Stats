<?php
//using PHP Spotify API library to make OAuth authorization easier
require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    'a14f16defc434d5c9574d98fc2bde945',
    'ea84844e954348779762db488e4a4da9',
    'https://spotify-stats-php.herokuapp.com/callback.php'
);


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