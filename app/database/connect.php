<?php
$dbhost = 'localhost'; // Unlikely to require changing
$dbname = ''; // Modify these...
$dbuser = 'root'; // ...variables according
$dbpass = ''; // ...to your installation
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die('unable to connect: ');
if ($conn->connect_error) {
    die('database connection error: ' . $conn->connect_error);
}

?>