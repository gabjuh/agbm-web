<?php
    session_set_cookie_params(10800);
    session_start();

    require_once("class/textbox.class.php");

    // include("_path.php");

    require_once("class/songs.class.php");

    // Create a new song opbejt
    $song = new Songs();

    echo $song -> readSongFromDB();

    // Include song sound files
    $song -> listOfAudioFiles();

    // $song -> getInfosFromFilename();

    // Get the number of the verses
    $nrOfVerses = $song->getVersnr();


    // Set the number of the song
    if (isset($_GET['id'])) {
        $songNr = $_GET['id'];
    }
    

    


?>




<!doctype html>
<html lang="de">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    
    <!-- w3schools.com fontawesome kit -->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    
    <link rel="stylesheet" href="src/css/song.projection.css">
    <title><?php echo $songNr ." "; ?>Lied Projektion</title>


    </head>
<body>


    
  
    


    <div class="row">
        <div id="leftSide"></div>
        <div id="verseProjection">
            <div id="versNr"></div>
            <span id="text">

                <!-- Liedtext -->
                

                <script type="text/javascript">

                    // Get the variable from PHP songNr to JS
                    var songNr = ['<?php echo $songNr; ?>'];

                    

                    // alert(songNr);


                    // Get the verses from PHP to JS
                    var verses = ['<?php echo json_encode($song->getVerses()); ?>'];
                    
                    verses = JSON.stringify(verses);

                    // Delete the object special chars we wont need
                    verses = verses.replace(/\\r\\n/gi, '<br />');

                    verses = verses.replace(/{|}|"|:|\\|[|]/g, '');

                    // Correct the number before the first verse
                    verses = verses.replace('1', '1 ');          
                    
                    
                    // Place a <br /> element after each line, how it should be shown on the screen
                    for(i = 2; i <= 15; i++) {
                        verses = verses.replace(',' + i, '<br />' + i + ' ');
                    }

                
                    // Create an Array for the verses
                    verseArray = new Array();

                    // console.log(verses);
                    
                    // Get the variable from PHP nrOfVerses to JS
                    var nrOfVersesNr = ['<?php echo $nrOfVerses; ?>'];
                    
                    // console.log(nrOfVersesNr);
                    // console.log(typeof(nrOfVersesNr));

                    

                    // Convert object to numbers and encrease by one (to close 0 out)
                    nrOfVersesNr = Number(nrOfVersesNr)+1;
                    

                    // Push verseArray content
                    var i;
                    for (i = 1; i <= nrOfVersesNr; i++) {

                        if (i == 1) {

                            verseArray.push(verses.slice(0, verses.indexOf(i)));                            
                            
                        } else {

                            verseArray.push(verses.slice(verses.indexOf(i - 1), verses.indexOf(i)));

                        }

                    }

                    
                    // console.log(verseArray);

                    moreVerse = true;
                    verseNr = 1;




                    var audioFiles = ['<?php echo json_encode($song->getFileList()) ?>'];

                    audioFiles = JSON.stringify(audioFiles);

                    audioFiles = audioFiles.replace(/{|}|"|:|\\|[|]/g, '');

                    audioFiles = audioFiles.replace("[", "").replace("[", "");

                    


                </script>


           


            </span>
        </div>
        <div id="rightSide">
            <div class="container" id="closeButtonBlock">
                <a href="javascript:close()"> <!----songs.admin.php--->
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <!-- <button class="fas buttons" id="close">Stop</button> -->
                    </button>
                </a>
            </div>
        </div>
    </div>
    
    <div id="verseNr">
        <!-- WLG 1,1 -->
    </div>
    <div id="footerArea">
        <div id="info">
                <span id="songNr"></span>
                <span id="actualVerse"></span>
                <span id="nrOfVerses"></span>
            </div>
        <div id="navigation">
            <button class="btn btn-default">
                <span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>
            </button>
            <div id="buttonBox">
                <button class="fas buttons disabledButton" id="left">&#xf053;</button>
                <button class="fas buttons" id="right">&#xf054;</button>
                <audio class="fas buttons" id="player" src=""> </audio>
                <!-- <button class="fas buttons" id="right">
                    <a id="button" title="button">&#xf04b</a>
                </button> -->
                <a id="playButton" title="button">
                    <button class="fas buttons">&#xf04b;</button>
                </a>

                <a id="stopButton" title="button">
                    <button class="fas buttons disabledButton disabledButton" disabled>&#xf04d;</button>
                </a>

                <!-- <?php $song->selectAvailableSongAudioFile(); ?> -->

                <select name="songSelect" id="songSelect" class="custom-select bg-dark text-white" disabled>
                    <option value="0" id="noFiles" selected >Es steht keinen Audiofile zur Verfügung.</option>
                </select>
                
                

                <span id="Timer" style="color:white;">00:00</span>
                
                <!-- <button class="fas buttons" id="player">Play</button> -->
                <!-- <button class="fas buttons" id="stop">Stop</button> -->
            </div>            
        </div>
    </div>
    
    <script src="src/js/songs.files.js"></script>
    <script src="src/js/songs.projection.js"></script>
    <script src="src/js/music.play.js"></script>
    
    
      
</body>

</html>