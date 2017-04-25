<?php

require_once("conf.php");

$db = new PDO("mysql:host=localhost;dbname=toucan_tevans;charset=UTF8", "toucan", "WFkPC8gyEhlqTi7yVkVoczgMz");
$stmt = $db->prepare("SELECT school_id, school_name FROM schools ORDER BY school_name");
$stmt->execute();
$all_schools = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($all_schools as &$school){
    $school["school_id"] = htmlspecialchars($school["school_id"]);
    $school["school_name"] = htmlspecialchars($school["school_name"]);
    $school["checked"] = (isset($_SESSION["input"]["schools"]) and in_array($school["school_id"], $_SESSION["input"]["schools"])) ? "checked" : "";
}

?>