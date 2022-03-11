function verseNrCheck() {
    var value = parseInt(document.getElementById("versnr").value);
    // document.getElementById()

    for (i = 1; i <= 15; i++) {      
        var id = "verseBox" + i;
        var id = document.getElementById(id);
        if (i <= value) {
            id.style.display = "flex";
        } else {
            id.style.display = "none";
        }

    }
    
}