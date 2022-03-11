<?php

    class Textbox{

        public function insertText($text) {
?>

  <div class="infoText">
    <div class="container text-center">
        <div class="row d-flex justify-content-center" id="img">
            <div class="col-center-xl-8 col-md-8 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body text-center">
                        <!-- <h5 class="card-title mb-0 text-center"><br>Mediathek</h5> -->
                        <div class="card-text text-black-70">
                        <?php echo $text; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

<?php

        }



}


?>