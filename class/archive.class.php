<?php

    class Archive {

        private $dir = "mp3/";

        // private $dir = "D:/Gabesz/.ideiglenes/archiv_agbm_trial";

        private $fileList = [];

        private $fileNames = [];

        private $tableHeaders = [
            "ID.",
            "Datum",
            "Prediger",
            "Datenschutz",
            "Links"
        ];

        private $id = "";

        private $date = "";

        private $name = "";

        private $dbNames = [];

        private $dbNameIdTemp = 0;

        private $tableFinalNames = [];

        private $permittedNames = [];

        private $prayerReading = "";




        public function setException($name) {

            if (in_array($name, $this->permittedNames) != true) {

                $this->permittedNames[] = $name;

            }
        }
        


        public function listOfFiles() {

            if ($handle = opendir($this->dir))

                while (false !== ($entry = readdir($handle))) {
                    
                    if ($entry != "." && $entry != ".." && substr($entry, -3, 3) == "MP3") {
                        
                        $this->fileList[] = $entry;                    
                    }                  
                }

                // while ($entry = readdir($handle)) {

                //     echo $entry ."\n";

                // }
            
                closedir($handle);

        }




        

        public function getInfosFromFilename($filename) {

            $this->id = substr($filename, 0, 3);

            $y = "20" .substr($filename, 4, 2);
            $m = substr($filename, 7, 2);
            $d = substr($filename, 10, 2);

            $this->date = $d ."." .$m ."." .$y;

            // $n = strpos($filename, '--');

            $n = substr($filename, 13);

            $repl = [
                "-",
                "--",
                "HB",
                "Hb",
                "Mitte",
                ".MP3"
            ];
            
            $this->name = str_replace($repl, "", $n);

            $this->fileNames[] = $this->name;

            return $this->name;

        }



        public function getNamesFromDb() {

            $sql = "SELECT id, name, permition FROM preachers";

            require_once("inc/db.inc.php");

            if ($stmt = $pdo->prepare($sql)) {

                $stmt ->execute();

            }

            while ($z = $stmt -> fetch()) {

                $this->dbNames[] = $z;
                // print_r($z);

            }
        }



        public function checkForPermission($keyDbNames, $dbFullName, $alternativeName = "") {

            if ($this->dbNames[$keyDbNames][2] == "true" && in_array($dbFullName, $this->permittedNames) != true) {

                if ($alternativeName) {

                    $this->permittedNames[] = $alternativeName;

                } else {

                    $this->permittedNames[] = $dbFullName;

                }

                

            }

        }




        public function compareNamesWithDb ($name) {

            $nameFromDB = "";

            $nameCode = substr($name, strpos($name, ".") +1, 5);


            foreach ($this->dbNames as $keyDbNames => $valDbNames) {

                foreach ($valDbNames as $key => $dbFullName) {

                    if (strpos($dbFullName, $nameCode) !== false) {

                        if (strpos($name, "Gebet")) {

                            $this->prayerReading = " - Gebetslesung";

                        }

                        $this->checkForPermission($keyDbNames, $dbFullName);

                        // Solve name differences

                        if (strpos($dbFullName, "Pietr") !== false && strpos($name, "Chr") !== false) {

                            $n = $this->dbNames[2][1];

                            $this->checkForPermission($keyDbNames, $dbFullName, $n);

                            return $n;

                        } elseif (strpos($dbFullName, "Pietr") !== false && strpos($name, "R.P") !== false) {

                            $n = $this->dbNames[4][1];

                            // $this->checkForPermission($keyDbNames, $dbFullName, $n); //Not working at this time

                            return $n;

                        } elseif (strpos($dbFullName, "Pietr") !== false && strpos($name, "S.Pietruska") !== false) {

                            $n = $this->dbNames[9][1];

                            // $this->checkForPermission($keyDbNames, $dbFullName, $n); //Not working at this time

                            return $n;

                        }
                        

                        return $dbFullName;
    
                    } 
                    
                }

            }          
            
        }




        public function buildTable() {

            $this->listOfFiles();

            sort($this->fileList);

            $t = "<div class=\"container\">"

                ."<div class=\"table-responsive\">"

                ."<table class=\"table table-hover table-sm\">\n"

                ."<thead>\n<tr>\n";

            // Table header

            foreach ($this->tableHeaders as $val) {

                $t .= "<th scope=\"col\">$val</th>\n";

            }

            $t .= "</tr></thead>";


            $i = 0;

            foreach ($this->fileList as $val) {

                $name = $this->getInfosFromFilename($val);

                // ID.
                $t .= "<tr><td>$this->id</td>\n";


                // Date
                $t .= "<td>$this->date</td>\n";
                

                // Name                
                $t .= "<td>";

                $pr = "";

                if ($finalName = $this->compareNamesWithDb($name)) {

                    if ($this->prayerReading != "") {

                        $pr = $this->prayerReading;
    
                    }

                    $t .= $finalName .$pr;

                    $this->prayerReading = "";   

                } else {

                    $t .= $name;

                }

                $t .= "</td>\n";


                // Permission
                $t .= "<td>"; 

                $download = "";
                
                if (in_array($finalName, $this->permittedNames)) {

                    $t .=   '<svg width="1.3em" height="1.7em" viewBox="0 0 16 16" class="bi bi-check2-circle text-info" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                <path fill-rule="evenodd" d="M8 2.5A5.5 5.5 0 1 0 13.5 8a.5.5 0 0 1 1 0 6.5 6.5 0 1 1-3.25-5.63.5.5 0 1 1-.5.865A5.472 5.472 0 0 0 8 2.5z"/>
                            </svg>';

                } else {

                    $download = "disable";

                    $t .= "<span class=\"nichtAngegeben \">Nicht geklärt</span>";

                }

               

                
                
                
                $t .="</td>\n";


                // Links

                if ($download == "disable") {

                    $t .= "<td class=\"tdLink\"><a class=\"fa fa-play btn btn-outline-secondary  btn-sm btnLink disabled\" title=\"Abspielen\" href=\"\" target=\"_blank\"></a>"
                    ."<a class=\"fa fa-download btn btn-outline-secondary  btn-sm btnLink disabled\" title=\"Herunterladen\" href=\"\" download></a></td>\n";

                } else {

                    $t .= "<td class=\"tdLink\"><a class=\"fa fa-play btn btn-outline-info btn-sm btnLink\" title=\"Abspielen\" href=\"$this->dir$val\" target=\"_blank\"></a>"
                    ."<a class=\"fa fa-download btn btn-outline-info btn-sm btnLink\" title=\"Herunterladen\" href=\"$this->dir$val\" download></a></td>\n";

                }
               


                $t .= "</tr>";

                $i++;

            }

            $t .= "</table></div></div>";
            

            echo $t;

            
            


        }




    }



?>