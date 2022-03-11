<?php

    class Songs {

        private $table = "songs";

        private $tablePrimaryKey = "id";

        private $tableOrderedBy = "id";

        private $columns = [
            "Nr." => "id",
            "Titel" => "title",
            "Str.anzahl" => "versnr",
            "Strophe 1" => "v1",
            "Strophe 2" => "v2",
            "Strophe 3" => "v3",
            "Strophe 4" => "v4",
            "Strophe 5" => "v5",
            "Strophe 6" => "v6",
            "Strophe 7" => "v7",
            "Strophe 8" => "v8",
            "Strophe 9" => "v9",
            "Strophe 10" => "v10",
            "Strophe 11" => "v11",
            "Strophe 12" => "v12",
            "Strophe 13" => "v13",
            "Strophe 14" => "v14",
            "Strophe 15" => "v15"
        ];

        private $id = "";

        private $title = "";

        private $versnr = "";

        private $v = [];

        private $dir = ".songs/mp4";
        private $fileList = [];



        public function getVerses() {

            return $this->v;

        }

        public function getVersnr() {

            return $this->versnr;

        }

        public function getFileList() {

            return $this->fileList;

        }



       

        public function songsHeader() {

            ?>
            
                <div class="container">
                    <div class="row text-center" id="preachHeader">
                        <div class="col-md-2">Liednummer</div>
                        <div class="col-md-3">Titel</div>
                        <div class="col-md-4">Strophen</div>
                    </div>
                </div>
    
            <?php
        }



        public function readFromDb() {


            $sql = "SELECT * FROM songs ORDER BY id";

            $this->showSermon($sql);
                    

        }

        public function oneOreMoreVerses($number) {
            
            if ($number != 1) {
                echo " Strophen";
            } else {
                echo " Strophe";
            }

        }

        public function showSermon($sql) {
            require_once("inc/db.inc.php");

            echo "<div class=\"container\">\n<div class=\"accordion\">\n";

            

            if ($stmt = $pdo -> prepare($sql)) {
                $stmt -> execute();
                
                while ($z = $stmt -> fetch()) {

                    
                    $this->id = htmlspecialchars($z['id']);
                    
                    $this->title = htmlspecialchars($z['title']);
                    
                    $this->versnr = htmlspecialchars($z['versnr']); //itt at tudom adni a versszakszamot 
                    // $this->v[1] = htmlspecialchars($z["v1"]);
                    // $this->v[2] = htmlspecialchars($z["v2"]);
                    
                    
                    $this->v = [];

                    
                    
                    for ($i = 1; $i <= $this->versnr; $i++) {
                    
                        $versV = "v" . $i;
                    
                        $this->v[] = preg_replace("#(\n)#", "<br />", htmlspecialchars($z[$versV])); //<br />


                    }

                    ?>
                    
            <div>
            <div class="card">
                <div class="card-header" id="heading<?php echo $this->id; ?>">
                    <h5 class="mb-0">
                        <button class="btn" data-toggle="collapse" data-target="#collapse<?php echo $this->id; ?>" aria-expanded="true" aria-controls="collapse<?php echo $this->id; ?>">
                
                            <div class="row horisontalInfos">
                                <div class="col-md-1"><span class="verticalInfoSpan" id="songNumber"><?php echo $this->id; ?></span></div>
                                <div class="col-md-4 predigerName"><span class="verticalInfoSpan"><?php echo $this->title; ?></span></div>
                                <div class="col-md-2 predigerName"><span class="verticalInfoSpan"><?php echo $this->versnr; $this->oneOreMoreVerses($this->versnr); ?></span></div>
                            </div>

                            <div class="videoDatum"><?php echo $this->id; ?></div>
                           
                            <div class="row verticalInfos">
                                <div class="col-4 columnInfos">Titel</div>
                                <div class="col-8 columnValues"><?php echo $this->title; ?></div>
                            </div>
                            <div class="row verticalInfos">
                                <div class="col-4 columnInfos">Strophen</div>   
                                <div class="col-8 columnValues"><?php echo $this->versnr; ?></div>
                            </div>

                        </button>
                    </h5>
                 </div>
                
                <div id="collapse<?php echo $this->id; ?>" class="collapse" aria-labelledby="heading<?php echo $this->id; ?>" data-parent="#accordion">
                    <div class="card-body">
                        <!-- <h3 class="songTitel"><?php echo $this->id; ?></h3> -->
                        

                        <?php 
                        
                            $table = "<table class=\"table table-bordered table-responsive\">\n";
                            foreach ($this->v as $key=>$val) {
                                $verseNr = $key + 1;
                                if ($val != "") {
                                    $table .= "<td class=\"verses\"><div class=\"verseBox\">$verseNr</div>";
                                    $table .= "\n<div>$val</div></td>\n";
                                } else {
                                break;
                                }
                                
                            }
                            
                            $table .= "</table>\n";
                            $a = 2;
                            echo $table;
                            echo "<span class=\"songEdit\"><a href=\"songs.edit.php?$this->tablePrimaryKey="

                            .htmlspecialchars($z[array_values($this->columns)[0]])

                            ."\">Text bearbeiten</a></span>";

                            echo "<span class=\"songEdit\"><a href=\"songs.projection.php?$this->tablePrimaryKey="
                                .htmlspecialchars($z[array_values($this->columns)[0]])
                                ."\" target=\"_blank\">Lied projizieren</a></span>";

                        ?>
                    
                    </div>
                </div>
            </div>
            </div>
            <!-- </div>
            </div> -->


      
    

<?php


                    }

                }
            // }

            echo "</div>\n";
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

                } elseif ($value == "sub") {

                    if (isset($_POST['sub'])) {

                        $$postedValue = 1;

                    } else {

                        $$postedValue = 0;

                    }

                }  else {

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

                $$postedValue = $_POST[$value];

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

// echo $sql;

            
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


    public function readSongFromDB() {

        if (isset($_GET['id'])) {

            $sql = "SELECT * FROM songs WHERE id = " . $_GET['id'];

            require("inc/db.inc.php");

            if ($stmt = $pdo -> prepare($sql)) {

                $stmt -> execute();

                while ($z = $stmt -> fetch()) {

                    $this->is = htmlspecialchars($z['id']);

                    $this->title = htmlspecialchars($z['title']);

                    $this->versnr = htmlspecialchars($z['versnr']);

                    for ($i = 1; $i <= $this->versnr; $i++) {

                        $this->v[$i] = htmlspecialchars($z["v".$i]);

                    }

                }

                // return $this->v[1];

            }

        }

    }

    public function listOfAudioFiles() {

        if (strlen($_GET['id']) == 2) {
            
            $this->id = "0" .$_GET['id'];

        } elseif (strlen($_GET['id']) == 1) {

            $this->id = "00" .$_GET['id'];

        } else {

            $this->id = $_GET['id'];

        }

        // echo "<span style='color:white'>this ID: " .$this->id ."</span><br />";
        

        if ($handle = opendir($this->dir))

            while (false !== ($entry = readdir($handle))) {
                
                if ($entry != "." && $entry != ".." && substr($entry, -3, 3) == "mp4" && substr($entry, 0, 3) == $this->id) {  

                    // echo substr($entry, 0, 3) ."<br />";
                    
                    $this->fileList[] = $entry;     
                    
                    // print_r($this->fileList);
                }                  
            }

            // while ($entry = readdir($handle)) {

            //     echo $entry ."\n";

            // }

            // print_r($this->fileList);
        
            closedir($handle);

    }


    public function selectAvailableSongAudioFile() {

        

        // echo $this->fileList[0]
                    // ." (Aufnahme von der Gemeinde)";

            

            // if (count($this->fileList) > 1) {

           
                
                echo "<select class=\"custom-select bg-dark text-white\" id=\"songSelect\">";
                
                foreach ($this->fileList as $key => $val) {

                    $selected = "";

                    if ($key == 0) {

                        $selected = " selected";

                    }
                    
                    echo "<option class=\"recordings\" value=\"$val\" $selected>$val</option>";

                    /**
                     * Az egészet meg kellene csinálni js-ben, vagy csak a file-ok számát átadni
                     */

                }
                
            
            }

      



    






}
  

?>