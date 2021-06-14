<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="shortcut icon" type="image/jpg" href="img/spot.png"/>
  <title>Spotify Stats</title>    
</head>

<style>
html {
    height: 100%;
    }

body {
    height: 100%;
    margin: 0;
    background-image: linear-gradient(to top left, rgb(196, 196, 196), #242424);
    color: black;
    text-align: left;
    font-family: 'Courier New', Courier, monospace;

    }
h1 {
    text-align: center;
    font-size: 3rem;
}

p {
    border-right: solid 5px rgba(255,255,255,.75);
    white-space: nowrap;
    overflow: hidden;    
    font-family: 'Courier New', Courier, monospace;
    font-size: 6vmin;
    color: #37FD56;
    color: rgba(255,255,255,.70);
    text-align: left;
  }

p {
    animation: animated-text 1s linear 1s 1 normal both,
               animated-cursor 600ms linear infinite;
  }

  /* text animation */
  
@keyframes animated-text{
    from{width: 0%;}
    to{width: 90%;}
  }
  
  /* cursor animations */
  
@keyframes animated-cursor{
    from{border-right-color: rgba(255,255,255,.75);}
    to{border-right-color: transparent;}
  }



@media only screen and (max-width: 768px) {

p {
    font-size: 5vmin;
  }
@keyframes animated-text{
        from{width: 0%;}
        to{width: 100%;}
      }


}
</style>


<body>
<?php session_start();  ?>


  <div class="container justify-content-center">
    <br><br><p>Successfully Logged Out</p>
  </div>

<?php 

if (count($_SESSION) > 0) { //log out/delete session
    foreach ($_SESSION as $key => $value){
        unset($_SESSION[$key]);

    }  
    session_destroy();  

    setcookie('PHPSESID', '', time()-3600, "/" );
  }

if (count($_COOKIE) > 0) {
    foreach ($_COOKIE as $key => $val) {
      unset($_COOKIE[$key]); //unset value assigned to key in cookie, only removes from server side
  
      setcookie($key,'',time()-3600); //remove from client
  
    }
  
  
  }

  header("Refresh:3; url=login.php");  

?>
</body>
</html>