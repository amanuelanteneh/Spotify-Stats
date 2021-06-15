<?php   require 'vendor/autoload.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Spotify manipulation website">
  <meta name="author" content="Amanuel Anteneh">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link rel="stylesheet" href="style/main.css">
   <link rel="shortcut icon" type="image/jpg" href="img/spot.png"/>
  <title>Spotify Stats</title>
</head>

<body>
<?php

  session_start();
  if (!isset($_SESSION['user'])) {
      header("Location: https://spotify-stats-php.herokuapp.com/login.php");
  }
  else {
  try {    
    $api = new SpotifyWebAPI\SpotifyWebAPI();


    $api->setAccessToken($_SESSION['accessToken']);
  
    $myRecentSongs = $api->getMyRecentTracks();
    $albumCover1 = $myRecentSongs->items[0]->track->album->images[0]->url;
    $song1 = $myRecentSongs->items[0]->track->name;
    $albumCover2 = $myRecentSongs->items[1]->track->album->images[0]->url;
    $song2 = $myRecentSongs->items[1]->track->name;
    $albumCover3 = $myRecentSongs->items[2]->track->album->images[0]->url;
    $song3 = $myRecentSongs->items[2]->track->name;
    }
    catch (SpotifyWebAPI\SpotifyWebAPIException $e) {
      header("Location: logout.php");      
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
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

  </header>

  <!--carousel (bootstrap)-->
  <div id="carousel-main" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <!--add indicators-->
      <li data-target="#carousel-main" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-main" data-slide-to="1"></li>
      <li data-target="#carousel-main" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <!--first item to be shown-->
        <div class="d-flex justify-content-center">
          <img src=<?php echo $albumCover1 ?> class="d-block" alt="" id="song1">
        </div>
        <div class="d-flex justify-content-center">
           <span class="songName" id="songName1"> <?php echo $song1 ?> </span>
        </div>
        <div class="carousel-caption">
          <h1>Top Music</h1>
          <!--Top and bottom caption on carousel item-->
          <h3>See your top artists and songs!</h3>
        </div>
      </div>
      <div class="carousel-item">
        <div class="d-flex justify-content-center">
          <img src=<?php echo $albumCover2 ?> class="d-block" alt="" id="song2">
        </div>
        <div class="d-flex justify-content-center">
           <span class="songName" id="songName2"> <?php echo $song2 ?> </span>
        </div>
        <div class="carousel-caption">
          <h1>Related Music</h1>
          <h3>Find artists and songs similar to your favorites!</h3>
        </div>
      </div>
      <div class="carousel-item">
        <div class="d-flex justify-content-center">
          <img src=<?php echo $albumCover3 ?> class="d-block" alt="" id="song3">
        </div>
        <div class="d-flex justify-content-center">
           <span class="songName" id="songName3"> <?php echo $song3 ?> </span>
        </div>
        <div class="carousel-caption">
          <h1>Make a Playlist</h1>
          <h3>Create a playlist based off your top songs and artists!</h3>
        </div>
      </div>
    </div>
    <!--next and previous buttons-->
    <a class="carousel-control-prev" href="#carousel-main" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-main" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>

  </div>
<?php } 

?>
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
  <script type="text/javascript" src="js/index.js"></script> 
</body>

</html>