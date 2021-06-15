<?php
/* //using PHP Spotify API library to make OAuth authorization easier
require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    '0ec8ef8e321a49429a39d4bc87ca2188',
    'a030de15311a4109a06a2fbc92d89adc',
    'http://spotify-stats-php.herokuapp.com/callback.php'
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

die();*/

require_once("spotify-api.php");

if (!isset($_SESSION['spotify_auth'])) {
    if (!isset($_GET['code'])) {
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
    }
    else {
        $session->requestAccessToken($_GET['code']);
        $accessToken = $session->getAccessToken();
   //     setcookie("spot_auth", $accessToken, time() + (86400 * 30), "/");
        $_SESSION['spotify_auth'] = $accessToken;
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}

?>