<?php

require_once("../alert_class.php");
require_once("../conf.php");
require_once("../fetch_all_schools.php");

if (isset($_SESSION["alerts"])){
    $alerts = $_SESSION["alerts"];
    unset($_SESSION["alerts"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body><div class="container-fluid">
    <?php
    if (isset($alerts)){
        foreach ($alerts as $alert){
            echo($alert->to_bootstrap());
        }
    }
    ?>
    <h1>Add member</h1>
    <?php
    include("../add_member_form.php");
    ?>
    <hr>
    <h1>List members per school</h1>
    <?php
    include("../members_per_school_form.php");
    ?>
    <hr>
    <?php
    include("../members_per_school_table.php");
    ?>
</div></body>
</html>