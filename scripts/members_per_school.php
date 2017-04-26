<?php

require_once("alert_class.php");
require_once("conf.php");

# Store POSTed values in SESSION just in case registration fails
$_SESSION["input"] = $_POST;

$alerts = [];

# Check school exists
if (!isset($_POST["school"])){
    $alerts[] = new Alert("School is missing", "danger");
    $_SESSION["alerts"] = $alerts;
    session_commit();
    header('Location: ../www');
    exit();
} elseif (!filter_var($_POST["school"], FILTER_VALIDATE_INT)){
    $alerts[] = new Alert("Invalid input for school", "danger");
    $_SESSION["alerts"] = $alerts;
    session_commit();
    header('Location: ../www');
    exit();
}
$query = $db->prepare("SELECT school_name FROM schools WHERE school_id = :school");
$query->bindParam(":school", $_POST["school"], PDO::PARAM_INT);
$query->execute();
# exit early if school does not exist
if ($query->rowCount() == 0){
    $alerts[] = new Alert("School not found", "danger");
    $_SESSION["alerts"] = $alerts;
    session_commit();
    header('Location: ../www');
    exit();
}
$school_name = $query->fetch(PDO::FETCH_ASSOC)["school_name"];

# Fetch members
$query = $db->prepare("SELECT m.member_name, m.member_email FROM members m JOIN school_members sm ON m.member_id = sm.member_id WHERE sm.school_id = :school ORDER BY m.member_name, m.member_email");
$query->bindParam(":school", $_POST["school"], PDO::PARAM_INT);
$query->execute();
$members = $query->fetchAll(PDO::FETCH_ASSOC);

$_SESSION["requested_school"] = htmlspecialchars($school_name);
foreach ($members as &$member){
    $member["member_name"] = htmlspecialchars($member["member_name"]);
    $member["member_email"] = htmlspecialchars($member["member_email"]);
}
unset($member);
$_SESSION["members"] = $members;
$_SESSION["alerts"] = $alerts;
session_write_close();
header('Location: ../www');
exit();

?>