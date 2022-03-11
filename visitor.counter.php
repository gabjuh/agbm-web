<?php

	
	include("_path.php");

	$columns = [
		"ID" => "id",
		"Datum" => "date",
		"Monatsumme" => "msum",
		"Summe" => "sum"
	];
	
	// Get previous stand
	
    // $counterstand = intval(file_get_contents($path . "/counter/counter.txt"));
	
	$sql = "SELECT MAX(sum) FROM visitors";
	
	
	require_once("inc/db.inc.php");
	
	$x = "";

	if ($stmt = $pdo -> prepare($sql)) {

		$stmt -> execute();
		
		while ($z = $stmt -> fetch()) {
			
			//foreach ($columns as $key=>$value) {
				
				//if ($value == "sum") {
					
					//$x = htmlspecialchars($z["Summe"]);
					//echo "yep";
					
				//}
				
			//}
			
			echo htmlspecialchars($z["Summe"]);
			
		}
		
		echo $x;
		
		
		
	}
 
	

	
	// Check IP in Session
	
	//if(!isset($_SESSION['counter_ip']))
     //   {
     //   $counterstand++;
		
		
		// Save new visit
     //   file_put_contents($path . "/counter/counter.txt", $counterstand);
        
     //   $_SESSION['counter_ip'] = true;
   // }
	
	
	
	// Print actual stand

	//echo $counterstand;
	


?>