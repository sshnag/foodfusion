<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "foodfusion";

$connection = new mysqli($host, $user, $password, $dbname);

// if ($connection->connect_error) {
//     die("Connection failed: " . $connection->connect_error);
// }
// else {
//     echo"Connection Success!";
// }