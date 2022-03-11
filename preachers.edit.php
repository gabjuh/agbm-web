<?php

    require_once("header.php");
    require_once("navigation.admin.php");

    require("class/preachers.class.php");
    
    
    
    $preacher = new Preacher();

    if (isset($_POST["mode"])) {
        if ($_POST["mode"] == "null") {
            $preacher -> createDataLine($_POST);
        } else {
            $preacher -> editDataLine($_POST);
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
    $tData = $preacher -> readDataLine($_GET["id"]);
    $id = $_GET["id"];


    





    // EDIT

?>



    <h3 class="tableTitle">Prediger bearbeiten</h3>



<!-- ide -->



    <form action="" method="post">
        <div class="form-group row">
            <input type="hidden" name="mode" id="mode" value="<?php echo $id; ?>">
        </div>

        <div class="form-group row justify-content-center">
            <label for="id" class="col-sm-2 col-form-label ">Nr.:</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" id="id" name="id" value="<?php echo $id; ?>" disabled>
            </div>
        </div>
    
        <div class="form-group row justify-content-center">
            <label for="name" class="col-sm-2 col-form-label">Name:</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" id="name" name="name" maxlength="50"  placeholder="Maximale Länge: 50 Karakter." value="<?php echo $tData['name']; ?>">
            </div>
        </div>
        
        <div class="form-group row justify-content-center">
            <label for="permition" class="col-sm-3 col-form-check-label"></label>
            <div class="col-sm-1">
                <input class="form-check-input" type="checkbox" id="permition" name="permition" value="permition"
                
                <?php 

                    if ($tData['permition'] == "true") {
                        echo "checked";
                    } 

                ?>
                
                >
            </div>
            <label for="sub" class="col-md-8 col-form-check-label checkboxLabel">Datenschutz-Dokument unterschrieben</label>
        </div>

        <button class="btn btn-info saveBtn">Speichern</button>
        <a href="admin.php" class="btn btn-info saveBtn">Zurück</a>
        <a class="btn btn-outline-danger delBtn" role="button" href="preachers.del.php?id=<?php echo $id; ?>">Löschen</a>
    </div>
</form>


</div>                    

</div>
                </div>
            </div>
        </div>
    </div>
  </div>



<?php 


} else {

?>



<form action="" method="POST">
    <div class="form-group row">
        <input type="hidden" name="mode" id="mode" value="null"/>
    </div>

    <div class="form-group row justify-content-center">
        <label for="id" class="col-sm-2 col-form-label">Nr.: </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" id="id" name="id" value="AUTO" disabled />
        </div>
    </div>
    
    <div class="form-group row justify-content-center">
        <label for="name" class="col-sm-2 col-form-label">Name: </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" id="name" name="name" maxlength="50"  placeholder="Maximale Länge: 50 Karakter."  value="" />
        </div>
    </div>
    
    
    <div class="form-group row justify-content-center">
        <div class="col-sm-1" class="col-sm-2 col-form-label">
            <input type="checkbox" id="permition" name="permition" value="true" />
        </div>
        <label for="permition">Datenschutz-Dokument unterschrieben</label>
    </div>
    


    <button class="btn btn-info saveBtn">Speichern</button>
    <a href="admin.php" class="btn btn-info saveBtn">Zurück</a>
</form>

</div>
            </div>
        </div>
    </div>
  </div>
  </div>
  </div>





<?php
}

$box->closeBox();


?>
</div>
<?php
    

}
    
    require_once("footer.php");
   

?>