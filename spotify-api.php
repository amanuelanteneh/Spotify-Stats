<?php

GLOBAL $api;

require_once('vendor/autoload.php'); // Composer reqs.

session_start();

// API info, from the configuration file.
$session = new SpotifyWebAPI\Session(
    '0ec8ef8e321a49429a39d4bc87ca2188',
    'a030de15311a4109a06a2fbc92d89adc',
    'https://spotify-stats-php.herokuapp.com/callback.php'
);

// Current user information.
$_SESSION['user'] = "Guest";

$api = new SpotifyWebAPI\SpotifyWebAPI();

// Check if a Spotify auth. token is set.
if (isset($_SESSION['spotify_auth'])) {
    $api->setAccessToken($_SESSION['spotify_auth']); // Set session to token.

    try {
        $userProfile = $Spotify_API->me(); // Get user from token.

        $_SESSION['user'] = $userProfile->id;
        
    } catch (Exception $e) {
        // Something went wrong, remove this auth.
        unset($_SESSION['spotify_auth']);
    }
}

?>