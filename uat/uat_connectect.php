<?php

$hostname = "http://localhost/Salwa_ERP";

$servername = "localhost";
$username = "root";
$password = "";
$db = "ajax";

// Create connection
$connec = new mysqli($servername, $username, $password, $db);

// Check connection
if ($connec->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>