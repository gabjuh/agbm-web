<?php 


    class Accordion {

        private $table = "sermons";

        private $id = "000";

        private $datum = "";

        private $name = "";

        private $titel = "";

        private $bibeltext = "";

        private $video = "";

        private $videoWidth = "500"; //800

        private $videoHeight = "300"; //500

        private $subTitel = false;

        private $subTitleText = "";

        private $authorized = "true";       
        
        
        // public function __construct($id, $date, $name, $link, $sub, $authorized) {
        //     $this->id = $aktuellerId;
        //     $this->datum = $aktuellerDatum;
        //     $this->titel = $aktuellerTitel;
        //     $this->video = $videoLink;
        // }

        public function setId($aktuellerId) {
            $this->id = $aktuellerId;
        }

        public function setDatum($aktuellerDatum) {
            $this->datum = $aktuellerDatum;
        }

        public function setName($aktuellerName) {
            $this->name = $aktuellerName;
        }

        public function setTitel($aktuellerTitel) {
            $this->titel = $aktuellerTitel;
        }

        public function setBibeltext($aktuellerBibeltext) {
            $this->bibeltext = $aktuellerBibeltext;
        }

        public function setVideo($videoLink) {
            $this->video = $videoLink;
        }

        public function getVideo() {
            return $this->video;
        }

        public function changeVideoWidth($width) {
            $this->videoWidth = $width;
        }

        public function changeVideoHeight($height) {
            $this->videoHeight = $height;
        }

        public function turnSubtitelTextOn($boolean) {
            if ($boolean == true) {
                $this->subTitleText = "<small class=\"subt\">Für den Ein- oder Außblenden des Untertitels wähle in der rechten Ecke unten den Sign <img src=\"src/img/subtitelico.png\" alt=\"Untertitel Ein/Ausschalten Sign\">.</small>";
            }
        }

        public function authorizedSpeacher($boolean) {
            $this->authorized = $boolean;
        }

        public function didntSetYet($x) {
            if ($x == "") {
                echo "<i class=\"nichtAngegeben\">Nicht angegeben</i>";
            } else {
                echo $x;
            }
        }


        

        // public function readAccordionFromDB() {
        //     $sql = "SELECT id, date, name, link, subtitle
        //         FROM " .$this->table ."
        //         ORDER BY date DESC";
        //     $this->showAccordion($sql);
        // }

        // public function showAccordion($sql) {
        //     require_once("inc/db.inc.php");
        //     if ($stmt = $pdo -> prepare($sql)) {
        //         $stmt -> execute();
                
                
                

        //         while ($z = $stmt -> fetch()) {
        //             echo "z";
        //             echo "bla";
        //             $this->id = htmlspecialchars($z['id']);
        //             $this->datum = htmlspecialchars($z['date']);
        //             $this->titel = htmlspecialchars($z['name']);
        //             $this->video = htmlspecialchars($z['link']);
        //             $this->subTitleText = htmlspecialchars($z['subtitle']);

        //             echo "<div class=\"card\">\n" 
        //             ."<div class=\"card-header\" id=\"heading" .$this->id ."\">\n"
        //             ."<h5 class=\"mb-0\">\n"
        //             ."<button class=\"btn\" data-toggle=\"collapse\" data-target=\"#collapse" .$this->id ."\" aria-expanded=\"true\" aria-controls=\"collapse" .$this->id ."\">\n"
        //             .$this->datum ."\n"
        //             ."</button>\n"
        //             ."</h5>\n"
        //             ."</div>\n"
        //             ."<div id=\"collapse" .$this->id ."\" class=\"collapse\" aria-labelledby=\"heading" .$this->id ."\" data-parent=\"#accordion\">\n"
        //             ."<div class=\"card-body\">\n"
        //             ."<h3>"  .$this->titel ."</h3>\n"
        //             ."<div class=\"embed-responsive embed-responsive-16by9\">\n"
        //             ."<iframe width=\"" .$this->videoWidth ."\" height=\"" .$this->videoHeight ."\"\n"
        //             ." src=\"https://www.youtube.com/embed/" .$this->video ."\"\n"
        //             ." frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\n"
        //             ."</div>\n"
        //             .$this->subTitleText
        //             ."</div>\n</div>\n</div>\n\n\n";

        //             echo "banyek";
        //         } 

        //     }else {
        //         echo "nemmegy";
        //     }
        // }


        public function preacherHeader() {

        ?>
        
            <div class="row text-center" id="preachHeader">
                <div class="col-md-3">Datum</div>
                <div class="col-md-3">Prediger</div>
                <div class="col-md-3">Thema</div>
                <div class="col-md-3">Bibeltext</div>
                
            </div>

        <?php
        }

     


        public function createAccordion() {

            if ($this->authorized == true) {

    ?>
    <div class="card accordion">
        <div class="card-header" id="heading<?php echo $this->id; ?>">
            <h5 class="mb-0">
                <button class="btn" data-toggle="collapse" data-target="#collapse<?php echo $this->id; ?>" aria-expanded="true" aria-controls="collapse<?php echo $this->id; ?>">
                <div class="row horisontalInfos">
                    <div class="col-md-3"><?php echo $this->datum; ?></div>
                    <div class="col-md-3"><?php echo $this->name; ?></div>
                    <div class="col-md-3"><?php $this->didntSetYet($this->titel); ?></div>
                    <div class="col-md-3"><?php $this->didntSetYet($this->bibeltext); ?></div>
                </div>

                <div class="videoDatum"><?php echo $this->datum; ?></div>
                
                <div class="row verticalInfos">
                    <div class="col-4 columnInfos">Prediger</div>   
                    <div class="col-8 columnValues"><?php echo $this->name; ?></div>
                </div>
                <div class="row verticalInfos">
                    <div class="col-4 columnInfos">Thema</div>
                    <div class="col-8 columnValues"><?php echo $this->didntSetYet($this->titel); ?></div>
                </div>
                <div class="row verticalInfos">
                    <div class="col-4 columnInfos">Bibeltext</div>   
                    <div class="col-8 columnValues"><?php echo $this->didntSetYet($this->bibeltext); ?></div>
                </div>

                </button>
            </h5>
        </div>
        <div id="collapse<?php echo $this->id; ?>" class="collapse" aria-labelledby="heading<?php echo $this->id; ?>" data-parent="#accordion">
            <div class="card-body">
                <h3 class="videoTitel"><?php echo $this->name ." – " .$this->titel; ?></h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="<?php echo $this->videoWidth; ?>" height="<?php $this->videoHeight; ?>" src="https://www.youtube.com/embed/<?php echo $this->video; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            <?php echo $this->subTitleText; ?>
            </div>
        </div>
    </div>

    <?php




            }
            
        }


    }



?>