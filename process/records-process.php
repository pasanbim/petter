<?php 

include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

$user = $_SESSION['email'];

if (isset($_POST['petid']) && !empty($_POST['petid'])) {

    $petid = $_POST['petid'];
    $sql = "SELECT * FROM records WHERE petid = '$petid'";
    $result = $conn->query($sql);
    $records = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
        echo json_encode($records);

    } else {
        sendJsonResponse(2, "No records found");
    }

}


?>