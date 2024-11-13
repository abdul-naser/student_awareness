<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_awareness_db";

// Create a connection to the database
$mysqli  = new mysqli($servername, $username, $password, $dbname);

mysqli_character_set_name($mysqli);
mysqli_set_charset($mysqli,"utf8");
// Check connection
if ($mysqli ->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>