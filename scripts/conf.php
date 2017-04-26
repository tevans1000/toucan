<?php

// Prevent frame-jacking
header('Content-Security-Policy: frame-ancestors X-Frame-Options: DENY');

// Set default timezone
date_default_timezone_set('GB');

// Start the session (if not already started)
if (session_status() == PHP_SESSION_NONE){
    session_start();
}

// Connect to database
$db = new PDO("mysql:host=localhost;dbname=toucan_tevans;charset=UTF8", "toucan", "WFkPC8gyEhlqTi7yVkVoczgMz");

?>