$(document).ready(function() {

    console.log(audioFiles);

    var audioFilesArray = new Array();

    var nrOfFiles = (audioFiles.match(/.mp/g) || []).length; //from mp4 changed to .mp, that it may involve mp3 ex.

    var selectedFile;

    var i;
    for (i = 1; i <= nrOfFiles; i++) {

        audioFilesArray.push(audioFiles.slice(0, audioFiles.indexOf(".mp4") + 4));
        audioFiles = audioFiles.substring(audioFiles.indexOf("mp4") + 4);

    }

    

    

    if (audioFilesArray.length != 0) {

        $('#songSelect').removeAttr("disabled");

        $('#noFiles').removeAttr("selected").remove();

        var i;
        for (i = 0; i <= audioFilesArray.length - 1; i++) {

            var selected = "";

            if (i == 0) {

                selected = "selected";

                $('#songSelect').append("<option class=\"options\" value=\"" + audioFilesArray[i] + "\" id = \"file" + i + "\"" + selected + ">" + audioFilesArray[i] + "</option>");

            } else {

                $('#songSelect').append("<option class=\"options\" value=\"" + audioFilesArray[i] + "\" id = \"file" + i + "\"" + selected + ">" + audioFilesArray[i] + "</option>");
                

            }

            

        }

    }


    // $('#file1').click(function() {

    //     alert("bla");
    //     // $('#songSelect option:selected').attr('selected', false);
    //     // $(this).attr('selected', true);

    // });


    console.log(audioFilesArray);
});