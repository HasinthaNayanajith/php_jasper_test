<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "elibrary";

$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn){
    die("Database not connected.");
}
?>