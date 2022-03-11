$(document).ready(function() {
    
    // variable for the audio player
    var playing = false;
    var paused = false;
    var sound = document.getElementById('player');
    
    // showing the first verse as default
    // $('#text').text(verses[1]);

    // var versesArray = new Array();

    // verses.forEach((verse) => {
    //     versesArray.push(verse);
    //     console.log(verse);
    // });

    // console.log(verses);

    // vvv.push();

    
// console.log(verses);
// console.log(verses.length);

    

    

    



    // functions for th counter
    function get_elapsed_time_string(total_seconds) {
        function pretty_time_string(num) {
          return ( num < 10 ? "0" : "" ) + num;
        }
      
        // var hours = Math.floor(total_seconds / 3600);
        // total_seconds = total_seconds % 3600;
      
        var minutes = Math.floor(total_seconds / 60);
        total_seconds = total_seconds % 60;
      
        var seconds = Math.floor(total_seconds);
      
        // Pad the minutes and seconds with leading zeros, if required
        // hours = pretty_time_string(hours);
        minutes = pretty_time_string(minutes);
        seconds = pretty_time_string(seconds);
      
        // Compose the string for display
        var currentTimeString = minutes + ":" + seconds; //hours + ":" +
      
        return currentTimeString;
        
    }





    
    // It sets the path for the player, defqault ist the first file 
    $('#player').attr('src', '.songs/mp4/' + $('#songSelect option:selected').val());

    // Every time we click on the select element, it refreshes the path
    $('#songSelect').click(function() {

        $('#player').attr('src',  '.songs/mp4/' +  $('#songSelect option:selected').val());

    });


    


    // behaviors for the play-stop buttons
    $('#playButton').click(function() {        

        // if it is not playing anything - as default - shows play sign
        // after clicking starts to play, the signs changes to pause
        if (playing == false) {

            if ($('#player').attr('src') == "") {

                alert("Für das Lied gibt es keine Aufnahme.");
                // $('#playButton > button').prop("disabled", true).addClass("disabledButton");

            } else {

                sound.play();
                playing = true;
                $('#playButton > button').html("&#xf04c;");
                $('#stopButton > button').prop("disabled", false).removeClass("disabledButton");
                $('#songSelect').prop("disabled", true);

            }
            

            

            

            // var start = new Date;
            
            // setInterval(function() {

            //     $('#Timer').text((new Date - start) / 1000 );
            // }, 1000);



            // EZ JÓ CSAK KI KELL TALÁLNI HOGYAN MŰKÖDIK, ezt tartozik a felsö kodhoz

            var elapsed_seconds = 0;

            setInterval(function() {
                elapsed_seconds = elapsed_seconds + 1;
                $('#Timer').text(get_elapsed_time_string(elapsed_seconds));
            }, 1000);

            
        } else {

            // if it already plays audio, stops playing and changes the icos as play/pause
            sound.pause();
            // console.log(sound.currentTime);
            playing = false;
            paused = true;
            $('#playButton > button').html("&#xf04b;&#xf04c;"); 

            
        }

    });

    // if you click stop, it won't continue the audio, and turns play ico back to default
    $('#stopButton').click(function() {

        if (playing == true || paused == true) {
            sound.pause();
            sound.currentTime = 0;
            playing = false;
            $('#playButton > button').html("&#xf04b;");
            $('#stopButton > button').prop("disabled", true).addClass("disabledButton");
            $('#songSelect').prop("disabled", false);
            
        }

    });


    // this script reads timing data from txt files
    fetch('.songs/mp4/060.txt')
    .then(response => response.text())
    .then(data => {
        var verseTimes = data.split('\n');
        console.log(verseTimes[1]);
        console.log(sound.currentTime);

        // if (console.log(verseTimes[1]) >= sound.currentTime) {
        //     alert("sdfsdfds");
        // };

        
        

    });
    $('#left').addClass('disabledButton').prop("disabled", true);

    // Set song Nr below
    $('#songNr').text("WLG " + songNr + ",");

    

    var nr = nrOfVersesNr - 1;
    $('#nrOfVerses').text("(" + nr + ")");


    // left and right button for change verses
    var v = 1;
    // $('#versNr').html( v );
    $('#text').html(verseArray[v]);

    // actual versenumber below set
    $('#actualVerse').text(verseArray[v].charAt(0));


    $('#left').click(function() {
        if (v > 1) {
            $('#text').html(verseArray[v -= 1]);   
        }

        if (v == 1) {
            $('#left').addClass('disabledButton').prop("disabled", true);
        }
        
        if (v < nrOfVersesNr -1) {
            $('#right').removeClass('disabledButton').prop("disabled", false);
        }
        
        $('#actualVerse').text(verseArray[v].charAt(0));

        // $('#actualVerse').text(nrOfVersesNr[v][0]);

    });

    $('#right').click(function() {
        if (v <= 14) {
            $('#text').html(verseArray[v += 1]);
        }        

        if (v > 1) {
            $('#left').removeClass('disabledButton').prop("disabled", false);
        }
        
        if (v == nrOfVersesNr -1) {
            $('#right').addClass('disabledButton').prop("disabled", true);
        }

        $('#actualVerse').text(verseArray[v].charAt(0));
        
    });

    // alert(nrOfVersesNr - 1);

    


    // these functions is for able to change slides with the keyboard RIGHT and LEFT arrows.
    // at the same time it changes the generated verse number with the verses.
    document.onkeydown = function(e) {
        switch(e.key) {
            case "ArrowLeft": // left
            if (v > 1) {
                $('#text').html(verseArray[v -= 1]);   
            }
    
            if (v == 1) {
                $('#left').addClass('disabledButton').prop("disabled", true);
            }
            if (v < nrOfVersesNr -1) {
                $('#right').removeClass('disabledButton').prop("disabled", false);
            }
            break;

            case "ArrowRight": // right
            if (v <= nrOfVersesNr - 2) {
                $('#text').html(verseArray[v += 1]);
            }        
    
            if (v > 1) {
                $('#left').removeClass('disabledButton').prop("disabled", false);
            }
            
            if (v == nrOfVersesNr -1) {
                $('#right').addClass('disabledButton').prop("disabled", true);
            }
            default: return; // exit this handler for other keys
        }
        e.preventDefault(); // prevent the default action (scroll / move caret)
    };


    // if ($('.recordings')) {

    //     var filename = $('.recordings').text();

    //     alert(filename);

    // }
    

    
});



