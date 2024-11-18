<?php

$servername = "localhost";
$username = "fansite";
$password = "Natsume055!!!";
$dbname = "fansitedb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>