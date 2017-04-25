<?php

require_once("conf.php");
require_once("alert_class.php");

# Store POSTed values in SESSION just in case registration fails
$_SESSION["input"] = $_POST;

$alerts = [];

# Email validation
if (!isset($_POST["email"])){
    $alerts[] = new Alert("Email is missing", "danger");
} elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    $alerts[] = new Alert("Email invalid", "warning");
} else {
    $email = $_POST["email"];
}

# Member name validation
if (!isset($_POST["member_name"])){
    $alerts[] = new Alert("Name is missing", "danger");
} elseif (strlen(trim($_POST["member_name"])) > 255){
    $alerts[] = new Alert("Name is too long", "warning");
} elseif (!preg_match("/^[\pL '-]*$/", trim($_POST["member_name"]))){
    $alerts[] = new Alert("Name contains invalid characters", "warning");
} else {
    $name = trim($_POST["member_name"]);
}

# Schools validation
if (empty($_POST["schools"])){
    $alerts[] = new Alert("At least 1 school must be selected", "warning");
} else {
    $schools = $_POST["schools"];
}

# Exit early if validation failed
if (empty($email) or empty($schools)){
    $_SESSION["alerts"] = $alerts;
    session_commit();
    header('Location: www');
    exit();
}

# Check if this is a new or existing user
$stmt = $db->prepare("SELECT member_id, member_name FROM members WHERE member_email = :email");
$stmt->bindParam(":email", $email, PDO::PARAM_STR);
$stmt->execute();
$is_new_member = ($stmt->rowCount() == 0);
# require a name for new members, check names match for existing members
if ($is_new_member){
    # exit early for new members if name is empty
    if (empty($name)){
        $alerts[] = new Alert("Name is required for new members", "warning");
        $_SESSION["alerts"] = $alerts;
        session_commit();
        header('Location: www');
        exit();
    }
    # create a new member and get the member_id
    $stmt = $db->prepare("INSERT INTO members (member_name, member_email) VALUES (:name, :email)");
    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $stmt = $db->prepare("SELECT member_id FROM members WHERE member_email = :email");
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
} else {
    # exit early for current members if a name is provided which is not the current name
    $current_name = $stmt->fetch(PDO::FETCH_ASSOC)["member_name"];
    if (!empty($name) and $name != $current_name){
        $alerts[] = new Alert("\"$name\" can't register using \"$email\" as \"$current_name\" is already registered using that email address. The database has not been updated.", "warning");
        $_SESSION["alerts"] = $alerts;
        session_commit();
        header('Location: www');
        exit();
    } else {
        $alerts[] = new Alert("\"$current_name\" is already registered using \"$email\". New memberships will be added and old memberships will be unaffected.", "info");
    }
}
$member_id = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]["member_id"];

$stmt_str = "INSERT IGNORE INTO school_members (school_id, member_id) VALUES ";
for ($i = 0; $i < count($schools); $i++){
    $stmt_str = $stmt_str . ($i == 0 ? "" : ", ") . "(:school$i, :member)";
}
$stmt = $db->prepare($stmt_str);
for ($i = 0; $i < count($schools); $i++){
    $stmt->bindParam(":school$i", $schools[$i], PDO::PARAM_INT);
}
$stmt->bindParam(":member", $member_id, PDO::PARAM_INT);
$registration_suceeded = $stmt->execute();

if ($registration_suceeded){
    $alerts[] = new Alert("Registration successful", "success");
    $_SESSION["input"] = [];
} else {
    $alerts[] = new Alert("Registration failed", "danger");
}

$_SESSION["alerts"] = $alerts;
session_commit();
header('Location: www');
exit();

?>