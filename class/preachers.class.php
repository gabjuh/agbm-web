<?php

    class Preacher {

        private $table = "preachers";

        private $tablePrimaryKey = "id";

        private $tableOrderedBy = "name";

        private $columns = [
            "Nr." => "id",
            "Name" => "name",
            "Datenschutz Formular" => "permition"
        ];



        public function readAllDataFromTable() {
            
            $c = "";
            
            foreach ($this->columns as $key=>$value) {
            
                if ($value != end($this->columns)) {
                    $c .= $value . ", ";
                } else {
                    $c .= $value;
                }
            }
            
            $sql = "SELECT " . $c . " FROM " .$this->table . " ORDER BY " . $this->tableOrderedBy;

            $this -> buildPreacherTable($sql);
        }




        public function buildPreacherTable($sql) {

            $neuButton = "<a href=\"preachers.edit.php\" class=\"btn btn-info btn-sm editBtn neuBtn\" >Neu hinzufügen</a><br/>";
            
            require_once("inc/db.inc.php");

            if ($stmt = $pdo -> prepare($sql)) {

                $stmt -> execute();


                $table = "<div class=\"container\" id=\"preachersTable\">" 

                        ."<div class=\"table-responsive\">" 

                        .$neuButton
                        
                        ."<table class=\"table table-hover table-sm table-hover\">\n"

                        ."<thead>\n<tr>\n";


                // Table header

                foreach ($this->columns as $key=>$value) {

                    $table .= "<th scope=\"col\">$key<th>\n"; //EZITTNEMJOOOOOOOOO, be kell zarni a th-ts

                }


                $table .= "<th scope=\"col\"></th>\n"

                        ."</tr>\n</thead>\n<tbody>\n";


                // Table content
                
                while ($z = $stmt -> fetch()) {

                    $table .= "<tr>\n";

                    foreach ($this->columns as $key=>$value) {

                        if ($value == "name") {

                            $table .= "<td class=\"namesInColumn\">$z[$value]</td>";
    
                        } elseif ($value == "permition") {
                            if ($z[$value] == "true") {
                                $table .= "<td><span class=\"green\">Schon unterschrieben</span></td>";
                            } else {
                                $table .= "<td><span class=\"red\">Noch fehlt</span></td>";
                            } 
                        } else {
                            $table .= "<td>" .htmlspecialchars($z[$value]) ."</td>";
                        }
                      
                             $table .= "\n<td>";
                                
                    }


                    $table .= "<td><a class=\"btn btn-outline-info btn-sm editBtn\" href=\"preachers.edit.php?$this->tablePrimaryKey="

                            .htmlspecialchars($z[array_values($this->columns)[0]])

                            ."\">Bearbeiten</a></td>"

                            ."\n</tr>\n";
                    
                }

                

                // $suchenButton = "<a href=\"#\" class=\"btn btn-info btn-sm editBtn neuBtn\" >Suchen</a>";

                $suchenButton = "";

                $table .= "</table>\n$neuButton$suchenButton\n</div>\n</div>";

                echo $table;

                

            }

        }




        public function readDataLine($id) {

            require("inc/db.inc.php");

            $s = "";         

            foreach ($this->columns as $key=>$value) {

                if ($this->tablePrimaryKey != $value) {

                    if ($value != end($this->columns)) {
                        $s .= $value . ", ";
                    } else {
                        $s .= $value;
                    }

                }

            }

            $sql = "SELECT " .$s ." FROM " .$this->table ." WHERE " .$this->tablePrimaryKey ."=:" .$this->tablePrimaryKey;

            if ($stmt = $pdo -> prepare($sql)) {
                $stmt -> bindParam(":" .$this->tablePrimaryKey, $id);
                $stmt -> execute();
                return($stmt -> fetch(PDO::FETCH_ASSOC));
            }
            return(false);

        }






        public function editDataLine() {

            require("inc/db.inc.php");

            foreach ($this->columns as $key=>$value) {

                $postedValue = $value;

                if ($value == $this->tablePrimaryKey) {

                    $$postedValue = $_POST["mode"];

                    // echo "$" . $value . " = " .$$postedValue . "<br />";

                } elseif ($value == "permition") {

                    if (isset($_POST['permition'])) {

                        $$postedValue = "true";

                    } else {

                        $$postedValue = "false";

                    }

                } else {

                    $$postedValue = $_POST[$value];

                    // echo "$" . $value . " = " .$$postedValue . "<br />";

                }

            }


            $sql = "UPDATE " .$this->table . " SET ";

            foreach ($this->columns as $key=>$value) {

                if ($value != $this->tablePrimaryKey) {
                
                    if ($value != end($this->columns)) {

                        $sql .= $value ." = :" .$value .", ";

                    } else {

                        $sql .= $value ." = :" .$value;

                    }

                } 

            }

            $sql .= " WHERE " .$this->tablePrimaryKey ." = :" .$this->tablePrimaryKey;

            




            if ($stmt = $pdo -> prepare($sql)) {

                foreach ($this->columns as $key=>$value) {

                    $ph = ":" .$value;
                
                    $pkph = $$value;
                
                    if ($value == $this->tablePrimaryKey) {
                
                        $param[$ph] = $pkph;
                
                    } else {
                
                        $param[$ph] = $$value;
                
                    }   
                    
                }

            }

            if ($stmt -> execute($param)) {

                echo "<h2 class=\"dataSaved\">Die Daten wurden erfolgreich gespeichert.</h2>";

            } else {

                echo "<h2 class=\"dataNotSaved\">Ein Fehler ist aufgetreten, die Daten wurden nicht gespeichert.</h2>";

            }


        }





        public function createDataLine() {
            require("inc/db.inc.php");

            foreach ($this->columns as $key=>$value) {

                $postedValue = $value;

                if ($value == $this->tablePrimaryKey) {

                    $$postedValue = NULL;

                    // echo "$" . $value . " = " .$$postedValue . "<br />";

                } else {

                    // Permition checkbox is checked if it is true or false

                    if ($value == "permition") {

                        if (isset($_POST['permition'])) {

                            $$postedValue = "true";

                        } else {

                            $$postedValue = "false";

                        }

                    } else {

                        $$postedValue = $_POST[$value];

                    }


                    // echo "$" . $value . " = " .$$postedValue . "<br />";

                }

            }

            $sql = "INSERT INTO " .$this->table . " (";

            $sqlVal = "VALUES (";

            foreach ($this->columns as $key=>$value) {  
            
                if ($value != end($this->columns)) {

                    $sql .= $value .", ";

                    $sqlVal .= ":" .$value .", ";

                } else {

                    $sql .= $value .") ";

                    $sqlVal .= ":" .$value .")";

                }

            }

            $sql .= $sqlVal;

            
            if ($stmt = $pdo -> prepare($sql)) {

                foreach ($this->columns as $key=>$value) {

                    $ph = ":" .$value;
                
                    $pkph = $$value;
                
                    if ($value == $this->tablePrimaryKey) {
                
                        $param[$ph] = $pkph;
                
                    } else {
                
                        $param[$ph] = $$value;
                
                    }   
                    
                }

            }

            if ($stmt -> execute($param)) {
                
                echo "<h2 class=\"dataSaved\">Die Daten wurden erfolgreich gespeichert.</h2>";

            } else {

                echo "<h2 class=\"dataNotSaved\">Ein Fehler ist aufgetreten, die Daten wurden nicht gespeichert.</h2>";

            }








        }

        public function deleteDataLine($id) {
            require("inc/db.inc.php");
            $sql = "DELETE FROM "   
                . $this->table
                ." WHERE id = :id";
            
            if ($stmt = $pdo -> prepare($sql)) {
                $stmt->bindParam(':id', $id);
                $stmt -> execute();
            }
        }






    }



?>