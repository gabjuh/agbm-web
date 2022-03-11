<?php

    //use on webgo
    $dbname = "web34_db20";
    $host = "localhost";
    $username = "web34_20";
    $password = "T3zZqOcwCq1ORLMVHsE0";



    //use on xampp
    //$dbname = "agbm";
    //$host = "localhost";
    //$username = "root";
    //$password = "";

    try {
        $pdo = new PDO (
            "mysql:dbname=$dbname;host=$host;charset=utf8",
            "$username", "$password");
        } catch ( PDOException $e ) {
            die ( $e->getMessage() );
    }

	
?>