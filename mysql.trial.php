<?php

    require_once("header.php");
    require_once("navigation.php");
    
    class Sermons {

        private $table = "sermons";

        private $id = 0;

        private $name = "";

        private $date = "";

        private $title = "";

        private $bibletext = "";

        private $video = "";

        private $sub = false;

        private $videoWidth = 800;

        private $videoHeight = 500;

        public function readFromDb() {
            $sql = "SELECT id, name, date, title, bibletext, video, sub
                FROM " .$this->table;
            
            $this->createSermon($sql);
        }

        public function didntSetYet($x) {
            if ($x == "") {
                echo "<i class=\"nichtAngegeben\">Nicht angegeben</i>";
            } else {
                echo $x;
            }
        }

        public function turnSubtitelTextOn($boolean) {
            if ($boolean == true) {
                $this->subTitleText = "<small class=\"subt\">Für den Ein- oder Außblenden des Untertitels wähle in der rechten Ecke unten den Sign <img src=\"src/img/subtitelico.png\" alt=\"Untertitel Ein/Ausschalten Sign\">.</small>";
            }
        }

        public function createSermon($sql) {
            require_once("inc/db.inc.php");
            if ($stmt = $pdo->prepare($sql)) {
                $stmt->execute();

            while ($z = $stmt -> fetch()) {

                $this->id = htmlspecialchars($z['id']);
                $this->name = htmlspecialchars($z['name']);
                $this->date = htmlspecialchars($z['date']);
                $this->title = htmlspecialchars($z['title']);
                $this->bibletext = htmlspecialchars($z['bibletext']);
                $this->video = htmlspecialchars($z['video']);
                $this->sub = htmlspecialchars($z['sub']);

                echo "<br>id: " .$this->id ."<br>Name: " .$this->name ."<br>Title: ". $this->title ."<br>Bibletext: ". $this->bibletext ."<br>Subtitle: ". $this->sub;

?>
<!-- 
                <div class="card accordion">
        <div class="card-header" id="heading<?php echo $this->id; ?>">
            <h5 class="mb-0">
                <button class="btn" data-toggle="collapse" data-target="#collapse<?php echo $this->id; ?>" aria-expanded="true" aria-controls="collapse<?php echo $this->id; ?>">
                <div class="row horisontalInfos">
                    <div class="col-md-3"><?php echo $this->date; ?></div>
                    <div class="col-md-3"><?php echo $this->name; ?></div>
                    <div class="col-md-3"><?php $this->didntSetYet($this->title); ?></div>
                    <div class="col-md-3"><?php $this->didntSetYet($this->bibletext); ?></div>
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
        <div id="collapse<?php echo $this->id; ?>" class="collapse" aria-labelledby="heading<?php $this->id; ?>" data-parent="#accordion">
            <div class="card-body">
                <h3 class="videoTitel"><?php echo $this->name ." – " .$this->title; ?></h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="<?php echo $this->videoWidth; ?>" height="<?php $this->videoHeight; ?>" src="https://www.youtube.com/embed/<?php echo $this->video; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            <?php echo $this->subTitleText; ?>
            </div>
        </div>
    </div> -->


    <?php

            }

            






            }
        }

        public function tableJoin() {
            $sql = "SELECT sermons.id AS sermonsId,
                    sermons.title,
                    preachers.id AS preachersId,
                    preachers.name,
                    sermons.bibletext,
                    sermons.video,
                    sermons.sub
                FROM sermons
                    JOIN preachers ON
                    sermons.name = preachers.name";

            $this->showJoinedTable($sql);
                    

        }

        public function showJoinedTable($sql) {
            require_once("inc/db.inc.php");

            if ($stmt = $pdo -> prepare($sql)) {
                $stmt -> execute();
                
                while ($z = $stmt -> fetch()) {

                }
            }
        }


        

    }
    
    $pr1 = new Sermons();
    $pr1->readFromDb();


    $pr2 = new Sermons();
    $pr2 -> tableJoin();
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    require_once("footer.php");


?>