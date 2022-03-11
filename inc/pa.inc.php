<?php

    function pa($thing, $exit = true) {

        $thing = array_map("utf8_encode", $thing);

        echo "<pre style=\"text-align:left;\">";

        print_r($thing);

        echo "</pre>";

        if ($exit) {
            exit();
        }

    }


?>