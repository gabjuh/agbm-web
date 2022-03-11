<?php

require_once("accordion.class.php");

    class Carussel extends Accordion {


        public function getYoutubeThumbnails() {
            $thumbnail = "http://img.youtube.com/vi/"  .$acc1->video ."/mqdefault.jpg";
            echo $acc->video;
        }

        public function createCarussel() {

            // $savedVideos = 9;
            
            // for ($i = 1; $i <= $savedVideos; $i++) {
            //     $acc = "acc$1";
            //     $$acc = new Accordion;
            //     echo $$acc->video;

            // }

    ?>

        <div class="container">
        <!-- <img src="src/img/erntedank_tisch_sm.jpg" class="img-fluid" alt="Erntedank Foto"> -->


        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
				
            </ol>
            <div class="carousel-inner">
				<div class="carousel-item active">
                    <img class="d-block w-100" src="src/img/stefan_mayr_dankbarkeit_sm.png" alt="Stefan Mayr - Dankbarkeit Slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Dankbarkeit</h5>
                        <p>Stefan Mayr - 13.02.2021</p>
                    </div>
				</div>
				
				<div class="carousel-item">
                    <img class="d-block w-100" src="src/img/guang_gesunder_glauben_sm.png" alt="G. Riemei - Gesunder Glauben Slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Gesunder Glauben</h5>
                        <p>Guangtulung Riemei - 11.07.2020</p>
                    </div>
                </div>
				<div class="carousel-item">
                    <img class="d-block w-100" src="src/img/samuel_behalte_den_fokus_sm.png" alt="Samuel Pietruska - Behalte den Fokus Slider">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Behalte den Fokus in schwieriger Zeit</h5>
                        <p>Samuel Pietruska - 31.10.2020</p>
                    </div>
                </div>
				<div class="carousel-item">
                    <img class="d-block w-100" src="src/img/ellen_weisse_kleid_sm.png" alt="Ellen Harder - Das Weiße Kleid Slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Zieht das weiße Kleid an!</h5>
                        <p>Ellen Harder - 24.10.2020</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="src/img/taufe_sm.png" alt="Taufe Slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Taufe von Elena Vlad</h5>
                        <p>Juri Gaus - 03.10.2020</p>
                    </div>
                </div>
				<div class="carousel-item">
                    <img class="d-block w-100" src="src/img/erntedank_tisch_sm.jpg" alt="Erntedank Slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Erntedank</h5>
                        <p>Serhiy Kapsamun - 06.09.2020</p>
                    </div>
                </div>
                
                
                
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>







<!-- 
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img class="d-block w-100" src="<?php echo $thumbnail; ?>" alt="First slide">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" src="..." alt="Second slide">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" src="..." alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div> -->
        </div>



    <?php
        }



    }



?>