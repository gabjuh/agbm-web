<?php

if ($_POST["username"] === "technik" && $_POST["password"] === "Ellen1844") {

    header("Location:admin.php");

} else {

    header("Location:signin.admin.php");
     
}



?>