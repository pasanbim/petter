<?php


if($_SERVER['SERVER_NAME']=="localhost"){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petter";

}

else{
    $servername = "localhost";
    $username = "u765950664_petter";
    $password = "2Dvc2QTxnJpC3hT";
    $dbname = "u765950664_petter";
}


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
