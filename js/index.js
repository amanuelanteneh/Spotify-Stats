var songName1 = document.getElementById("songName1");
var song1 = document.getElementById("song1");
var songName2 = document.getElementById("songName2");
var song2 = document.getElementById("song2");
var songName3 = document.getElementById("songName3");
var song3 = document.getElementById("song3");
var songName4 = document.getElementById("songName4");
var song4 = document.getElementById("song4")


song1.addEventListener("mouseover", () => {
	songName1.style.visibility = "visible";
});

song2.addEventListener("mouseover", () => {
	songName2.style.visibility = "visible";
});

song3.addEventListener("mouseover", () => {
	songName3.style.visibility = "visible";
});

song4.addEventListener("mouseover", () => {
	songName4.style.visibility = "visible";
});

song1.addEventListener("mouseout", () => {
	songName1.style.visibility = "hidden";
});

song2.addEventListener("mouseout", () => {
	songName2.style.visibility = "hidden";
});

song3.addEventListener("mouseout", () => {
	songName3.style.visibility = "hidden";
});

song4.addEventListener("mouseout", () => {
	songName4.style.visibility = "hidden";
});
