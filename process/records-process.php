<?php 

include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

if(isset($_SESSION['user'])) {
    $user = $_SESSION['email'];
} 

if (isset($_POST['recordid']) && !empty($_POST['recordid']) && isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'delete') {

    $recordid = $_POST['recordid'];
    $sql = "DELETE FROM records WHERE id = '$recordid' AND user = '$user'";
    if ($conn->query($sql) === TRUE) {
        sendJsonResponse(1, "Record deleted successfully");
    } else {
        sendJsonResponse(0, "Error deleting record: ");
    }
}

else if (isset($_POST['petid']) && !empty($_POST['petid'])) {

    $petid = $_POST['petid'];
    $sql = "SELECT * FROM records WHERE petid = '$petid' ORDER BY date DESC, id DESC";
    $result = $conn->query($sql);
    $records = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
        echo json_encode($records);

    } else {
        echo json_encode($records);

    }

}


?>