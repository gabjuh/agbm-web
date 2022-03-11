<?php

    class Sermon {

        private $table = "sermons";

        private $authorized = "true";   
        
        // private $subTitleText = "";

        private $tablePrimaryKey = "id";

        private $tableOrderedBy = "date";

        private $columns = [
            "Nr." => "id",
            "Name" => "name",
            "Datum" => "date",
            "Titel" => "title",
            "Bibeltext" => "bibletext",
            "Link" => "video",
            "Sub" => "sub"
        ];




        public function turnSubtitelTextOn($bool) {
            if ($bool == 1) {
                echo "<div><small class=\"subt\">Für den Ein- oder Außblenden des Untertitels wähle in der rechten Ecke unten den Sign <img src=\"src/img/subtitelico.png\" alt=\"Untertitel Ein/Ausschalten Sign\">.</small></div>";
            }
        }

        public function authorizedPreacher($boolean) {
            $this->authorized = $boolean;
        }

        public function didntSetYet($x) {
            if ($x == "") {
                $x = "<i class=\"nichtAngegeben\">Nicht angegeben</i>";
                return $x;
            } else {
                return $x;
            }
        }

        public function preacherHeader() {

            ?>
            
                <div class="container">
                    <div class="row text-center" id="preachHeader">
                        <div class="col-md-2">Datum</div>
                        <div class="col-md-3">Prediger</div>
                        <div class="col-md-4">Thema</div>
                        <div class="col-md-3">Bibeltext</div>
                    </div>
                </div>
    
            <?php
        }


        public function lastElevenChars($string) {
            return substr($string, -11);
        }

        public function readFromDb() {
            $sql = "SELECT sermons.id AS sermonsId,
                    DATE_FORMAT(date, '%d.%m.%Y') as date,
                    sermons.title,
                    preachers.id AS preachersId,
                    preachers.name,
                    sermons.bibletext,
                    sermons.video,
                    sermons.sub
                FROM sermons
                    JOIN preachers ON
                    preachers.id = sermons.name
                    ORDER BY YEAR(Date) DESC, MONTH(Date) DESC, DAY(Date) DESC";

            $this->showSermon($sql);
                    

        }

        public function showSermon($sql) {
            require_once("inc/db.inc.php");

            echo "<div class=\"container\">\n<div class=\"accordion\">\n";

            

            if ($stmt = $pdo -> prepare($sql)) {
                $stmt -> execute();
                
                while ($z = $stmt -> fetch()) {

                    $this->id = htmlspecialchars($z['sermonsId']);
                    $this->name = htmlspecialchars($z['name']);
                    $this->date = htmlspecialchars($z['date']);
                    $this->title = htmlspecialchars($z['title']);
                    $this->bibletext = htmlspecialchars($z['bibletext']);
                    $this->video = htmlspecialchars($z['video']);
                    $this->sub = htmlspecialchars($z['sub']);

                    $link = $this->lastElevenChars($this->video);
                    $youtubeThumbnail = "http://img.youtube.com/vi/$link/sddefault.jpg";
                    $youtubeThumbnail = "";


                    if ($this->authorized == true && $this->video != "") {

                        // und hier wird nachher alles ausgegeben, wenn es wahr ist

                    

                    ?>
                    
            <div>
            <div class="card">
                <div class="card-header" id="heading<?php echo $this->id; ?>">
                    <h5 class="mb-0">
                        <button class="btn" data-toggle="collapse" data-target="#collapse<?php echo $this->id; ?>" aria-expanded="true" aria-controls="collapse<?php echo $this->id; ?>">
                
                            <div class="row horisontalInfos">
                                <div class="col-md-2"><span class="verticalInfoSpan"><?php echo $this->date; ?></span></div>
                                <div class="col-md-3 predigerName"><span class="verticalInfoSpan"><?php //echo "<div class=\"youtubeThumbnailBox\"><img class=\"youtubeThumbnails\" src=\"$youtubeThumbnail\"></div>"; ?><?php echo $this->name; ?></span></div>
                                <div class="col-md-4"><span class="verticalInfoSpan"><?php echo $this->didntSetYet($this->title); ?></span></div>
                                <div class="col-md-3"><span class="verticalInfoSpan"><?php echo $this->didntSetYet($this->bibletext); ?></span></div>
                            </div>

                            <div class="videoDatum"><?php echo $this->date; ?></div>
                            
                            <div class="row verticalInfos">
                                <div class="col-4 columnInfos">Prediger</div>   
                                <div class="col-8 columnValues"><?php echo $this->name; ?></div>
                            </div>
                            <div class="row verticalInfos">
                                <div class="col-4 columnInfos">Thema</div>
                                <div class="col-8 columnValues"><?php echo $this->didntSetYet($this->title); ?></div>
                            </div>
                            <div class="row verticalInfos">
                                <div class="col-4 columnInfos">Bibeltext</div>   
                                <div class="col-8 columnValues"><?php echo $this->didntSetYet($this->bibletext); ?></div>
                            </div>

                        </button>
                    </h5>
                 </div>
                
                <div id="collapse<?php echo $this->id; ?>" class="collapse" aria-labelledby="heading<?php echo $this->id; ?>" data-parent="#accordion">
                    <div class="card-body">
                        <h3 class="videoTitel">
                            
                        <?php 
                        
                        
                        if ($this->title == "") {
                            $bindestrich = "";
                        } else {
                            $bindestrich = " – ";
                        }

                
                        
                        echo $this->name . $bindestrich .$this->title; 
                        
                        
                        
                        
                        ?></h3>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe width="<?php echo $this->videoWidth; ?>" height="<?php $this->videoHeight; ?>" src="https://www.youtube.com/embed/<?php echo $this->lastElevenChars($this->video); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    <!-- <?php echo $this->subTitleText; ?> -->

                    <?php
                    
                        if ($this->sub == 1) {
                            $this->turnSubtitelTextOn($this->sub);
                        }
                    
                    
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
            }

            echo "</div>\n";
        }


        


        public function readAllDataFromTable() {
            
            // $c = "";
            
            // foreach ($this->columns as $key=>$value) {
            
            //     if ($value != end($this->columns)) {
            //         $c .= $value . ", ";
            //     } else {
            //         $c .= $value;
            //     }
            // }
            
            // $sql = "SELECT " . $c . " FROM " .$this->table . " JOIN preachers ON sermons.id = preachers.id" ." ORDER BY " . $this->tableOrderedBy;

            $sql = "SELECT sermons.id,
                        preachers.name,
                        DATE_FORMAT(date, '%d.%m.%Y') as date,
                        sermons.title,
                        sermons.bibletext,
                        sermons.video,
                        sermons.sub
                    FROM sermons
                        JOIN preachers ON
                        preachers.id = sermons.name
                        ORDER BY YEAR(Date) DESC, MONTH(Date) DESC, DAY(DATE) DESC";

            $this -> buildSermonTable($sql);

            // print_r($sql);            
            
        }




        public function buildSermonTable($sql) {

            $neuButton = "<a href=\"sermons.edit.php\" class=\"btn btn-info btn-sm editBtn neuBtn\" >Neu hinzufügen</a><br/>";
            
            require("inc/db.inc.php");

            if ($stmt = $pdo -> prepare($sql)) {

                $stmt -> execute();


                $table = "<div class=\"container\">" 

                        ."<div class=\"table-responsive\">" 

                        .$neuButton
                        
                        ."<table class=\"table table-hover table-sm\">\n"

                        ."<thead>\n<tr>\n";


                // Table header

                foreach ($this->columns as $key=>$value) {

                    $table .= "<th scope=\"col\">$key</th>\n";

                }


                $table .= "<th scope=\"col\"></th>\n"

                        ."</tr>\n</thead>\n<tbody>\n";


                // Table content
                
                while ($z = $stmt -> fetch()) {

                    $table .= "<tr>\n";

                    foreach ($this->columns as $key=>$value) {

                        if ($value == "name") {

                            $table .= "<td class=\"namesInColumn\">$z[$value]</td>";
    
                        } elseif ($value == "sub") {
                            if ($z[$value]) {
                                $table .= "<td><span class=\"green\">✓</span></td>";
                            } else {
                                $table .= "<td>-</td>";
                            }
                            
                        } elseif ($value == "title" or $value == "bibletext") {
                            
                            $table .= "<td>" .$this->didntSetYet($z[$value]) ."</td>";
                            
                        } elseif ($value == "video") {

                            if ($z[$value] == "") {

                                $table .= "<td><img class=\"youtubeIco\" src=\"src/img/youtube_ico_gray.png\" title=\"Noch keinen Link angegeben.\" alt=\"youtube ico\"></td>";

                            } else {

                                $table .= "<td><a href=\"". htmlspecialchars($z[$value]) ."\" target=\"blank\" title=\"Öffnen im neuen Fenster: " . htmlspecialchars($z[$value]) ."\"><img class=\"youtubeIco\" src=\"src/img/youtube_ico.png\" alt=\"youtube ico\"></a></td>";

                            }

                        } else {

                            $table .= "<td>" .htmlspecialchars($z[$value]) ."</td>";
                        }              
                    
                        // $table .= "\n<td>";
                                
                    }


                    $table .= "<td><a class=\"btn btn-outline-info btn-sm editBtn\" href=\"sermons.edit.php?$this->tablePrimaryKey="

                            .htmlspecialchars($z[array_values($this->columns)[0]])

                            ."\">Bearbeiten</a></td>"

                            ."\n</tr>\n";
                    
                }

                $neuButton = "<a href=\"sermons.edit.php\" class=\"btn btn-info btn-sm editBtn neuBtn\" >Neu hinzufügen</a>";

                // $suchenButton = "<a href=\"#\" class=\"btn btn-info btn-sm editBtn neuBtn\" disabled>Suchen</a>";

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

                if ($value == $this->tablePrimaryKey) {

                    $$postedValue = NULL;

                    // echo "$" . $value . " = " .$$postedValue . "<br />";

                } else {

                    // Permition checkbox is checked if it is true or false

                    if ($value == "sub") {

                        if (isset($_POST['sub'])) {

                            $$postedValue = 1;

                        } else {

                            $$postedValue = 0;

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



        

        public function insertInputSelect($tab, $val, $text, $def) {
            
            $s = "<select class =\"custom-select\" name=\"" .$text ."\" id=\"" .$text ."\">\n\t";

            require("inc/db.inc.php");

            $sql = "SELECT " .$val .", " .$text ." FROM ".$tab;

            if ($def == "") {

                $s .= "\t<option>Name auswählen</option>\n";

            }

            if ($stmt = $pdo -> prepare($sql)) {

                $stmt -> execute();

                while ($z = $stmt ->fetch()) {

                    $s = $s ."\t\t<option value=\"" .$z[0] ."\"";

                    if ($z[0] == $def) {

                        $s = $s ." selected";

                    }

                    $s = $s .">" .$z[0] ." | " .$z[1] ."</option>\n";

                }

                $s = $s . "</select>\n";

                return $s;
 
            } else {

                return false;
            
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