<?php 

	include("_path.php");

    $counterstand = intval(file_get_contents($path . "/counter/counter.txt"));
 
    if(!isset($_SESSION['counter_ip']))
        {
        $counterstand++;
        file_put_contents($path . "/counter/counter.txt", $counterstand);
        
        $_SESSION['counter_ip'] = true;
    }
    
    echo $counterstand;

?>