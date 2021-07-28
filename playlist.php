<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="description" content="Spotify stats and more.">
    <meta name="author" content="Amanuel Anteneh">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/jpg" href="img/spot.png"/>
    <link rel="stylesheet" href="style/playlist.css">
    <title>Spotify Stats</title>

</head>

<body>

<?php 
  require 'vendor/autoload.php';
  session_start();
  if (!isset($_SESSION['user'])) {
      header("Location: login.php");
  }
  else {
?>
    <header>
    <!--Navbar (bootstrap)-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: black !important; box-shadow: 0 2px 4px 0 rgba(0,0,0,.9); !important;">
      <div class="name"><img src="img/spot.png" width="40" height="40">  Spotify Stats</div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link disabled" style="color: white;">Welcome, <?php echo $_SESSION['user'] ?>!</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="top.php">Top Music</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="playlist.php">Playlist</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

  </header>
    <div class="container text-center d-flex justify-content-center" id="inputContainer">
        <form id="inputForm" action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
            <div class="form-group">
                <label for="exampleFormControlInput1">Enter Name For Playlist</label>
                <input type="text" class="form-control" id="playlistNameInput" placeholder="Playlist Name" name="playlistName">
            </div>
            <div class="form-group"> <!-- Dropdown for interval option -->
                <label for="timeIntervalSelector">Create Playlist Based On Music From:</label>
                <select class="form-control" id="timeIntervalSelect" name="timeFrame">
                    <option>Last 4 weeks</option>
                    <option>Last 6 months</option>
                    <option>Last 2 years</option>
                </select>
                <button type="submit" class="btn" id="createButton" style="background-color: #37FD56; color: black;">Create
                Playlist</button>
            </div>
        </form>
    </div>

<?php
 if (isset($_GET['playlistName']) && $_GET['playlistName'] != "") { //place php here so error messages dont get echoed to top top of html doc
   
   $playlistName = $_GET['playlistName'];
   $timeFrame = $_GET['timeFrame'];
   try {    
        $api = new SpotifyWebAPI\SpotifyWebAPI();

        $api->setAccessToken($_SESSION['accessToken']);
  
        $optionsShort = $options = [
            'limit' => 10,
            'time_range' => "short_term"];
        $optionsMedium = $options = [
            'limit' => 10,
            'time_range' => "medium_term"];
        $optionsLong = $options = [
            'limit' => 10,
            'time_range' => "long_term"]; 

        $topTracksShort = $api->getMyTop('tracks', $optionsShort)->items;
        $topArtistsShort = $api->getMyTop('artists', $optionsShort)->items;
        $topTracksMedium = $api->getMyTop('tracks', $optionsMedium)->items;
        $topArtistsMedium = $api->getMyTop('artists', $optionsMedium)->items;
        $topTracksLong = $api->getMyTop('tracks', $optionsLong)->items;
        $topArtistsLong = $api->getMyTop('artists', $optionsLong)->items;

        if ($timeFrame == "Last 4 weeks") {
            //var_dump($topArtistsShort);
            $numArtists = count($topArtistsShort) - 1;
            $numTracks = count($topTracksShort) - 1;
            $options = [
            'limit' => 70,
            'seed_artists' => array($topArtistsShort[rand(0, $numArtists)]->id, $topArtistsShort[rand(0, $numArtists)]->id ),
            'seed_tracks' => array($topTracksShort[rand(0, $numTracks)]->id, $topTracksShort[rand(0, $numTracks)]->id, $topTracksShort[rand(0, $numTracks)]->id ),
            ];           
            $recs = $api->getRecommendations($options);
            $options = [
                'name' => $playlistName,
                ]; 
            $playlist = $api->createPlaylist($options);
            $playlistId = $playlist->id; 
            $trackIds = [];
            foreach ($recs->tracks as $track) {
                array_push($trackIds, $track->id);
            }
            $api->addPlaylistTracks($playlistId, $trackIds);
        }
        else if ($timeFrame == "Last 6 months") {

            $numArtists = count($topArtistsMedium) - 1;
            $numTracks = count($topTracksMedium) - 1;
            $options = [
            'limit' => 70,
            'seed_artists' => array($topArtistsMedium[rand(0, $numArtists)]->id, $topArtistsMedium[rand(0, $numArtists)]->id ),
            'seed_tracks' => array($topTracksMedium[rand(0, $numTracks)]->id, $topTracksMedium[rand(0, $numTracks)]->id, $topTracksMedium[rand(0, $numTracks)]->id ),
            ];           
            $recs = $api->getRecommendations($options);
            $options = [
                'name' => $playlistName,
                ]; 
            $playlist = $api->createPlaylist($options);
            $playlistId = $playlist->id; 
            $trackIds = [];
            foreach ($recs->tracks as $track) {
                array_push($trackIds, $track->id);
            }
            $api->addPlaylistTracks($playlistId, $trackIds); 

        }
        else {

            $numArtists = count($topArtistsLong) - 1;
            $numTracks = count($topTracksLong) - 1;
            $options = [
            'limit' => 70,
            'seed_artists' => array($topArtistsMedium[rand(0, $numArtists)]->id ,$topArtistsMedium[rand(0, $numArtists)]->id ),
            'seed_tracks' => array($topTracksMedium[rand(0, $numTracks)]->id ,$topTracksMedium[rand(0, $numTracks)]->id , $topTracksMedium[rand(0, $numTracks)]->id ),
            ];           
            $recs = $api->getRecommendations($options);
            $options = [
                'name' => $playlistName,
                ]; 
            $playlist = $api->createPlaylist($options);
            $playlistId = $playlist->id; 
            $trackIds = [];
            foreach ($recs->tracks as $track) {
                array_push($trackIds, $track->id);
            }
            $api->addPlaylistTracks($playlistId, $trackIds); 

        }
        echo "<span class='justify-content-center d-flex' style='color: #37FD56; font-family: 'Courier New', Courier, monospace;' id='message'><b>Playlist created, please check Spotify account.</b></span>";   
    }
    catch (SpotifyWebAPI\SpotifyWebAPIException $e) {
            header("Location: logout.php");      
        }
}  
else if (isset($_GET['playlistName']) && $_GET['playlistName'] == "") {
    echo "<span class='justify-content-center d-flex' style='color: #37FD56; font-family: 'Courier New', Courier, monospace;' id='message'><b>Please Enter a Playlist Name.</b></span>";
}
?>

<?php } ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>