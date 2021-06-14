var relatedArtists = document.getElementsByClassName("related-artist");

for (let i = 0; i < relatedArtists.length; i++) { //find related artist when clicked on 

    relatedArtists[i].addEventListener('click', () => {
        window.open(relatedArtists[i].alt);
    });

}