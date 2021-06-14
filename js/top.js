window.onload = function() { //wait for php to finish echoing html divs

var topShortTerm = document.getElementById("top-music-short"); 
var topMediumTerm = document.getElementById("top-music-medium"); 
var topLongTerm = document.getElementById("top-music-long"); 
//var topSongs = document.getElementsByClassName("song");  
//var topArtists = document.getElementsByClassName("artist");
var weeks = document.getElementById("weeks");
var months = document.getElementById("months");
var years = document.getElementById("years");


years.addEventListener("click", () => {
    years.classList.add('time-selector-active');
    years.classList.remove('time-selector');

    months.classList.remove('time-selector-active');
    months.classList.add('time-selector');

    weeks.classList.remove('time-selector-active');
    weeks.classList.add('time-selector');

    topShortTerm.style.display = "none";
    topMediumTerm.style.display = "none";
    topLongTerm.style.display = "flex";
});


months.addEventListener("click", () => {
    months.classList.add('time-selector-active');
    months.classList.remove('time-selector');

    years.classList.remove('time-selector-active');
    years.classList.add('time-selector');

    weeks.classList.remove('time-selector-active');
    weeks.classList.add('time-selector');

    topShortTerm.style.display = "none";
    topMediumTerm.style.display = "flex";
    topLongTerm.style.display = "none";
});


weeks.addEventListener("click", () => {
    weeks.classList.add('time-selector-active');
    weeks.classList.remove('time-selector');

    years.classList.remove('time-selector-active');
    years.classList.add('time-selector');

    months.classList.remove('time-selector-active');
    months.classList.add('time-selector');
   
    topShortTerm.style.display = "flex";
    topMediumTerm.style.display = "none";
    topLongTerm.style.display = "none";
});
}