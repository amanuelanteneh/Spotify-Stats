var intervalSelector = document.getElementById("timeIntervalSelect");
var playlistName = document.getElementById("playlistNameInput");
var createButton = document.getElementById("createButton");
var inputContainer = document.getElementById("inputContainer");
var message = document.getElementById("message");
/*
createButton.addEventListener("click", function () {
    if (playlistName.value != "") {
        document.getElementById("inputForm").remove();
        var loadingText = document.createElement("p");     // Create a <p> element
        loadingText.innerText = "Creating playlist...";
        inputContainer.appendChild(loadingText);
        setTimeout(function () {
            loadingText.remove();
            loadingText.innerText = "Playlist was created!";
            inputContainer.appendChild(loadingText);
            setTimeout(function () {
                loadingText.remove();
                loadingText.innerText = "Playlist name: " + playlistName.value;
                inputContainer.appendChild(loadingText);
            }, 5000);

        }, 6000);
    }
    else {
        //message.innerHTML = "<i><b>Please enter a playlist name.</b></i>";
    }
});*/