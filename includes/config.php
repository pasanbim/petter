<?php


// $servername = "localhost";
// $username = "u765950664_petter";
// $password = "2Dvc2QTxnJpC3hT";
// $dbname = "u765950664_petter";


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "petter";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>