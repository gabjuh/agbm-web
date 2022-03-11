<?php

include("error_reports.php");

require("_path.php");

require_once("header.php");
require_once("navigation.php");

require_once($path ."/class/textbox.class.php");
require_once($path ."/class/contentbox.class.php");

$box = new ContentBox();
$box -> openBox();



?>


<div class="container">
    <div id="login-row" class="row justify-content-center align-items-center">
        <div id="login-column" class="col-md-6">
            <div id="login-box" class="col-md-12">
                <form id="login-form" class="form" action="admin.check.php" method="post">
                    <h3 class="text-center text-info">Login</h3>
                    <div class="form-group">
                        <label for="username" class="text-info">Username:</label><br>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-info">Password:</label><br>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-info btn-md" value="Anmelden">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php

$box -> closeBox();















require_once("footer.php");

?>