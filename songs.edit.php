<?php

	//include("error_reports.php");
    require_once("header.php");
    require_once("navigation.admin.php");
	
	require("_path.php");

    require($path ."/class/sermons.class.php");
    
    require($path ."/class/songs.class.php");
    
    $song = new Songs();

    if (isset($_POST["mode"])) {
        if ($_POST["mode"] == "null") {
            $song -> createDataLine($_POST);
        } else {
            $song -> editDataLine($_POST);
        }
        header("refresh:2;url=songs.admin.php");
    } else {
?>
<div>

<?php



require_once("class/contentbox.class.php");

$box = new ContentBox();
$box->openBox();

$tData = array();

if (isset($_GET["id"])) {
    $tData = $song -> readDataLine($_GET["id"]);
    $id = $_GET["id"];

    // EDIT

?>


    <h3 class="tableTitle">Lied Nr. <?php echo $id; ?> bearbeiten</h3>


<!-- ide -->



<form action="" method="post">
            
        <div class="form-group row">
            <input type="hidden" name="mode" id="mode" value="<?php echo $id; ?>">
        </div>

        <div class="form-group row justify-content-center">
            <label for="id" class="col-md-2 col-form-label">Nr.:</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" id="id" name="id" value="<?php echo $id; ?>">
                </div>
            </div>
        
            <div class="form-group row justify-content-center">
                <label for="title" class="col-md-2 col-form-label">Titel:</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" id="title" name="title" value="<?php echo $tData['title']; ?>">
                </div>
            </div>

            <!-- <div class="form-group row justify-content-center">
                <label for="versnr" class="col-md-2 col-form-label">Strophen:</label>
                <div class="col-md-8">
                    <input class="form-control" type="versnr" id="versnr" name="versnr" placeholder="Anzahl der Strophen" value="<?php echo $tData['versnr']; ?>">
                </div>
            </div> -->

            <!-- VERSENUMBER AND REFRESH BUTTON -->

            <div class="form-group row justify-content-center">
                <label for="versnr" class="col-md-2 col-form-label">Strophen:</label>
                <div class="col-md-6">
                    <input class="form-control" onclick="verseNrCheck()" type="number" min="1" max="15" id="versnr" name="versnr" value="<?php echo $tData['versnr']; ?>">
                    
                </div>
                <a class="btn btn-info refreshBtn col-md-2" tabindex="10" onclick="verseNrCheck()">Aktualisieren</a>
            </div>


            <!-- LOOP FOR VERSES - EDIT-->

            <?php
        
                for ($i = 1; $i <= 15; $i++) {

                    $tDataName = "v" .$i;

                    ?>
                    
                    <div class="form-group row justify-content-center versBoxes" id="verseBox<?php echo $i; ?>">
                        <label for="v<?php echo $i; ?>" class="col-md-2 col-form-label versLabel"><?php echo $i; ?>. Strophe</label>
                        <div class="col-md-8">
                            <textarea class="form-control w-50" onclick="verseNrCheck()" type="text" id="v<?php echo $i; ?>" name="v<?php echo $i; ?>" maxlength="500"  rows="8" placeholder="Maximale Länge: 500 Karakter."><?php echo $tData[$tDataName]; ?></textarea>
                        </div>
                    </div>
                        
                    <?php


                }

            ?>


            <script src="src/js/verseNrCheck.js"></script>





           

            <button class="btn btn-info saveBtn">Speichern</button>
            <a href="songs.admin.php" class="btn btn-info saveBtn">Zurück</a>
            <a class="btn btn-outline-danger delBtn" role="button" href="songs.del.php?id=<?php echo $id; ?>">Löschen</a>
        </div>
</form>


</div>                    

<p>

    

</p>





<?php 


} else {

?>

<h3 class="tableTitle">Lied hinzufügen</h3>


  <form action="" method="post">
    <div class="form-group row">
        <input type="hidden" name="mode" id="mode" value="null">
    </div>

    <div class="form-group row justify-content-center">
        <label for="id" class="col-sm-2 col-form-label">Nr.:</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" id="id" name="id" placeholder="Liednummer" value="">
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="title" class="col-md-2 col-form-label">Titel:</label>
            <div class="col-md-8">
                <input class="form-control" type="text" id="title" name="title" placeholder="Titel des Liedes" value="">
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="versnr" class="col-md-2 col-form-label">Strophen:</label>
            <div class="col-md-6">
                <input class="form-control" onclick="verseNrCheck()" type="number" min="1" max="15" id="versnr" name="versnr" value="1">
                
            </div>
            <a class="btn btn-info refreshBtn col-md-2" tabindex="10" onclick="verseNrCheck()">Aktualisieren</a>
        </div>

        <!-- <div id="trial"></div> -->


        <!-- LOOP FOR VERSES - CREATE-->

        <?php
        
            for ($i = 1; $i <= 15; $i++) {

                $tDataName = "v" .$i;

                ?>
                
                <div class="form-group row justify-content-center versBoxes" id="verseBox<?php echo $i; ?>">
                    <label for="v<?php echo $i; ?>" class="col-md-2 col-form-label versLabel"><?php echo $i; ?>. Strophe</label>
                    <div class="col-md-8">
                        <textarea class="form-control w-50" onclick="verseNrCheck()" type="text" id="v<?php echo $i; ?>" name="v<?php echo $i; ?>" maxlength="500"  rows="8" placeholder="Maximale Länge: 500 Karakter."></textarea>
                    </div>
                </div>
                    
                <?php


            }

        ?>


        <script src="src/js/verseNrCheck.js"></script>

        


        <button class="btn btn-info saveBtn">Speichern</button>
        <a href="songs.admin.php" class="btn btn-info saveBtn">Zurück</a>
    </div>
</form>




<?php
}


$box->closeBox();





?>
</div>
<?php
    

}
    
    require_once("footer.php");
   

?>