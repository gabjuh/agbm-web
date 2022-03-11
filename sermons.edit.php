<?php

	//include("error_reports.php");
    require_once("header.php");
    require_once("navigation.admin.php");
	
	require("_path.php");

    require($path ."/class/sermons.class.php");
    
    
    
    $sermon = new Sermon();

    if (isset($_POST["mode"])) {
        if ($_POST["mode"] == "null") {
            $sermon -> createDataLine($_POST);
        } else {
            $sermon -> editDataLine($_POST);
        }
        header("refresh:2;url=admin.php");
    } else {
?>
<div>

<?php



require_once("class/contentbox.class.php");

$box = new ContentBox();
$box->openBox();

$tData = array();

if (isset($_GET["id"])) {
    $tData = $sermon -> readDataLine($_GET["id"]);
    $id = $_GET["id"];

    // EDIT

?>


    <h3 class="tableTitle">Predigt bearbeiten</h3>



<!-- ide -->



<form action="" method="post">
            
        <div class="form-group row">
            <input type="hidden" name="mode" id="mode" value="<?php echo $id; ?>">
        </div>

        <div class="form-group row justify-content-center">
            <label for="id" class="col-md-2 col-form-label">Nr.:</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" id="id" name="id" value="<?php echo $id; ?>" disabled>
                </div>
            </div>
        
            <div class="form-group row justify-content-center">
                <label for="name" class="col-md-2 col-form-label">Name:</label>
                <div class="col-md-8">
                    <!-- <input class="form-control" type="text" id="name" name="name" value="<?php echo $tData['name']; ?>"> -->
                    <?php echo $sermon->insertInputSelect("preachers", "id", "name", $tData['name']); ?> 
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <label for="date" class="col-md-2 col-form-label">Datum:</label>
                <div class="col-md-8">
                    <input class="form-control" type="date" id="date" name="date" value="<?php echo $tData['date']; ?>">
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <label for="title" class="col-md-2 col-form-label">Titel:</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" id="title" name="title" maxlength="50" placeholder="Maximale Länge: 50 Karakter." value="<?php echo $tData['title']; ?>">
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <label for="bibletext" class="col-md-2 col-form-label">Bibeltext:</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" id="bibletext" name="bibletext" maxlength="50" placeholder="Maximale Länge: 50 Karakter." value="<?php echo $tData['bibletext']; ?>">
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <label for="video" class="col-md-2 col-form-label">Youtube Link:<br /><small>(kurze Fassung!)</small></label>
                <div class="col-md-8">
                    <input class="form-control" type="text" id="video" name="video" maxlength="50" placeholder="Maximale Länge: 50 Karakter." value="<?php echo $tData['video']; ?>">
                </div>
            </div>
            
            <div class="form-group row justify-content-center">
                <label for="sub" class="col-md-3 col-form-check-label"></label>
                <div class="col-md-1">
                    <input class="form-check-input" type="checkbox" id="sub" name="sub" value="<?php echo $tData['sub']; ?>"
                    
                    <?php 

                        if ($tData['sub'] == 1) {
                            echo "checked";
                        } 

                    ?>
                    
                    >
                    
                </div>
                <label for="sub" class="col-md-8 col-form-check-label checkboxLabel">Untertitel hinzugefügt</label>
            </div>

            <button class="btn btn-info saveBtn">Speichern</button>
            <a href="admin.php" class="btn btn-info saveBtn">Zurück</a>
            <a class="btn btn-outline-danger delBtn" role="button" href="sermons.del.php?id=<?php echo $id; ?>">Löschen</a>
        </div>
</form>


</div>                    

<p>

    

</p>





<?php 


} else {

?>

<h3 class="tableTitle">Predigt hinzufügen</h3>


  <form action="" method="post">
    <div class="form-group row">
        <input type="hidden" name="mode" id="mode" value="null">
    </div>

    <div class="form-group row justify-content-center">
        <label for="id" class="col-sm-2 col-form-label">Nr.:</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" id="id" name="id" value="AUTO" disabled>
            </div>
        </div>
    
        <div class="form-group row justify-content-center">
            <label for="name" class="col-sm-2 col-form-label">Name:</label>
            <div class="col-sm-8">
                <!-- <input class="form-control" type="text" id="name" name="name" value=""> -->
                <?php echo $sermon->insertInputSelect("preachers", "id", "name", NULL); ?> 
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="date" class="col-sm-2 col-form-label">Datum:</label>
            <div class="col-sm-8">
                <input class="form-control" type="date" id="date" name="date" value="">
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="title" class="col-sm-2 col-form-label">Titel:</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" id="title" name="title" maxlength="50" placeholder="Maximale Länge: 50 Karakter." value="">
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="bibletext" class="col-sm-2 col-form-label">Bibeltext:</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" id="bibletext" name="bibletext" maxlength="50" placeholder="Maximale Länge: 50 Karakter." value="">
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="video" class="col-sm-2 col-form-label">Youtube Link:<br /><small>(kurze Fassung!)</small></label>
            <div class="col-sm-8">
                <input class="form-control" type="text" id="video" name="video" maxlength="50" placeholder="Nur bitte die kurze Fassung, wie zB. https://youtu.be/xxxxxxxxxxx, maximale Länge: 50 Karakter." value="">
            </div>
        </div>
        
        <div class="form-group row justify-content-center">
            <label for="sub" class="col-sm-3 col-form-check-label"></label>
            <div class="col-sm-1">
                <input class="form-check-input" type="checkbox" id="sub" name="sub" value="">
            </div>
            <label for="sub" class="col-sm-8 col-form-check-label checkboxLabel">Untertitel hinzugefügt</label>
        </div>

        <button class="btn btn-info saveBtn">Speichern</button>
        <a href="admin.php" class="btn btn-info saveBtn">Zurück</a>
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