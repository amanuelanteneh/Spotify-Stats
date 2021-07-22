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
    <link rel="stylesheet" href="style/top.css">
    <link rel="shortcut icon" type="image/jpg" href="img/spot.png"/>
    <title>Spotify Stats</title>
</head>

<body>
<?php 
  require 'vendor/autoload.php';
  
  session_start();
  if (!isset($_SESSION['user'])) {
      header("Location: https://spotify-stats-php.herokuapp.com/login.php");
  }
  else {

    function findRelatedArtist($artistID, $artistName, $artistImg ) {
        setcookie('artistID', $artistID, time()+3600);
        setcookie('artistName', $artistName, time()+3600);
        setcookie('artistImg', $artistImg, time()+3600);
        header("Location: related.php");
    }
    // to handle clicks on artist name
    if (isset($_GET['artistID'])){
        findRelatedArtist($_GET['artistID'], $_GET['artistName'], $_GET['artistImg']);
    }
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

        $topSongsShort = $api->getMyTop('tracks', $optionsShort);
        $topArtistsShort = $api->getMyTop('artists', $optionsShort);
        $topSongsMedium = $api->getMyTop('tracks', $optionsMedium);
        $topArtistsMedium = $api->getMyTop('artists', $optionsMedium);
        $topSongsLong = $api->getMyTop('tracks', $optionsLong);
        $topArtistsLong = $api->getMyTop('artists', $optionsLong);
    }
catch (SpotifyWebAPI\SpotifyWebAPIException $e) {
    header("Location: login.php");
}
   
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
            <a class="nav-link" href="recommendations.php">Recommendations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

  </header>

    <div class="container">
        <div class="row justify-content-center" id="timeSelector"> 
            <div id="weeks" class="text-center col-lg-4 mb-3 time-selector-active">
                4 Weeks Ago
            </div>
            <div id="months" class="text-center col-lg-4 mb-3 time-selector">
                6 Months Ago
            </div>
            <div id="years" class="text-center col-lg-4 mb-3 time-selector">
                2 Years Ago
            </div>
        </div>    
        <!--In bootstrap rows should be wrapped with containers-->
        <div class="row" id="top-music-short" style="display: flex;">

            <div class="text-center col-lg-6 mb-3">
                <div class="title">
                    <p>Top Artists</p>
                </div>
                <?php 
                    foreach ($topArtistsShort->items as $artist) {
                        echo "<div class='bubble-pop'> <div class='d-flex justify-content-center'><img src=" .  $artist->images[0]->url . " title='Find Related Artists' class='d-block artist'></div><span class='artistName'><a href='top.php?artistID=" . $artist->id . "&artistName=" . $artist->name . "&artistImg=" .  $artist->images[0]->url . "'>" . $artist->name . "</a></span></div>";
                    }
                ?>
            </div> 

            <div class="text-center col-lg-6 mb-3">
                <div class="title">
                    <p>Top Songs</p>
                </div>
                <?php 
                    foreach ($topSongsShort->items as $song) {
                        echo "<div class='bubble-pop-alt'> <div class='d-flex justify-content-center'><img src=" . $song->album->images[0]->url . " title='Go to song' class='d-block song'></div><span class='songName'><a href=" . $song->uri . "> " . $song->name . "</a></span></div>";
                    }
                ?>
            </div> 
        </div>
 
        <div class="row" id="top-music-medium" style="display: none;">

            <div class="text-center col-lg-6 mb-3">
                <div class="title">
                    <p>Top Artists</p>
                </div>
                <?php 
                    foreach ($topArtistsMedium->items as $artist) {
                        echo "<div class='bubble-pop'> <div class='d-flex justify-content-center'><img src=" .  $artist->images[0]->url . " title='Find Related Artists' class='d-block artist'></div><span class='artistName'><a href='top.php?artistID=" . $artist->id . "&artistName=" . $artist->name . "&artistImg=" .  $artist->images[0]->url . "'>" . $artist->name . "</a></span></div>";
                    }
                ?>
            </div> 

            <div class="text-center col-lg-6 mb-3">
                <div class="title">
                    <p>Top Songs</p>
                </div>
                <?php 
                    foreach ($topSongsMedium->items as $song) {
                        echo "<div class='bubble-pop-alt'> <div class='d-flex justify-content-center'><img src=" . $song->album->images[0]->url . " title='Go to song' class='d-block song'></div><span class='songName'><a href=" . $song->uri . "> " . $song->name . "</a></span></div>";
                    }
                ?>
            </div> 
        </div>    

        <div class="row" id="top-music-long" style="display: none;">

            <div class="text-center col-lg-6 mb-3">
                <div class="title">
                    <p>Top Artists</p>
                </div>
                <?php 
                    foreach ($topArtistsLong->items as $artist) {
                        echo "<div class='bubble-pop'> <div class='d-flex justify-content-center'><img src=" .  $artist->images[0]->url . " title='Find Related Artists' class='d-block artist'></div><span class='artistName'><a href='top.php?artistID=" . $artist->id . "&artistName=" . $artist->name . "&artistImg=" .  $artist->images[0]->url . "'>" . $artist->name . "</a></span></div>";
                    }
                ?>
            </div> 

            <div class="text-center col-lg-6 mb-3">
                <div class="title">
                    <p>Top Songs</p>
                </div>
                <?php 
                    foreach ($topSongsLong->items as $song) {
                        echo "<div class='bubble-pop-alt'> <div class='d-flex justify-content-center'><img src=" . $song->album->images[0]->url . " title='Go to song' class='d-block song'></div><span class='songName'><a href=" . $song->uri . "> " . $song->name . "</a></span></div>";
                    }
                ?>
            </div> 
        </div> 
    </div>
    <?php 
  }
    ?>
</body>


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
    <script type="text/javascript" src="js/top.js"></script> 

</html>