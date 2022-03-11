<?php


    class Input {

        private $settedForm = false;

        // Text

        public function openForm($hiddenMode, $primaryKey) {

            $f = "<form action=\"\" method=\"post\">\n";

            if ($hiddenMode == true) {

                $f .= "<div class=\"form-group row>\n\t"
                    ."<input type=\"hidden\" name=\"mode\" id=\"mode\" value=\"" . $primaryKey . "\">\n"
                    ."</div>\n";

            }

            $this->settedForm = true;


        }

        public function closeForm() {

            if ($this->settedForm = true) {

                echo "</form>";

            }



        }

        public function textInput() {




        }

        // Checkbox

        // Button



    }



?>