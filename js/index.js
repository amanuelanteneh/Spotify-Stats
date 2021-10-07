var songName1 = document.getElementById("songName1");
var song1 = document.getElementById("song1");
var songName2 = document.getElementById("songName2");
var song2 = document.getElementById("song2");
var songName3 = document.getElementById("songName3");
var song3 = document.getElementById("song3");
var songName4 = document.getElementById("songName4");
var song4 = document.getElementById("song4")


song1.addEventListener("mouseenter", () => {
	songName1.style.visibility = "visible";
});

song2.addEventListener("mouseenter", () => {
	songName2.style.visibility = "visible";
});

song3.addEventListener("mouseenter", () => {
	songName3.style.visibility = "visible";
});

song1.addEventListener("mouseleave", () => {
	songName1.style.visibility = "hidden";
});

song2.addEventListener("mouseleave", () => {
	songName2.style.visibility = "hidden";
});

song3.addEventListener("mouseleave", () => {
	songName3.style.visibility = "hidden";
});

