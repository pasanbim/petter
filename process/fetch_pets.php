<?php 

include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

$user = $_SESSION['email'];
$sql = "SELECT * FROM pets WHERE user = '$user'";
$result = $conn->query($sql);

$pets = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pets[] = $row;
    }
}

echo json_encode($pets);



?>