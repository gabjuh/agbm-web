$(document).ready(function() {

    console.log(audioFiles);

    var audioFilesArray = new Array();

    var nrOfFiles = (audioFiles.match(/mp4/g) || []).length;

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
        for (i = 1; i <= audioFilesArray.length; i++) {

            var selected = "";

            if (i == 1) {

                selected = "selected";

                $('#songSelect').append("<option class=\"options\" value=\"" + audioFilesArray[0] + "\" id = \"file" + i + "\"" + selected + ">" + audioFilesArray[i - 1] + "</option>");

            } else {

                $('#songSelect').append("<option class=\"options\" value=\"" + audioFilesArray[i] + "\" id = \"file" + i + "\"" + selected + ">" + audioFilesArray[i - 1] + "</option>");
                

            }

            

        }

    }


    $('#file1').click(function() {

        alert("bla");
        // $('#songSelect option:selected').attr('selected', false);
        // $(this).attr('selected', true);

    });


    console.log(audioFilesArray);
});