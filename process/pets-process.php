<?php 

include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';


date_default_timezone_set('Asia/Colombo');
$dateandtime = date('Y-m-d h:i A', time());



if (isset($_SESSION['email'])) {

    $user = $_SESSION['email'];

    if (isset($_POST['deleteid']) && !empty($_POST['deleteid'])) {
        $deleteid = $_POST['deleteid'];
        $sql = "DELETE FROM pets WHERE id = '$deleteid' AND user = '$user'";
        if ($conn->query($sql) === TRUE) {

            $sqlfornotification = "INSERT INTO notifications (message, time, user) VALUES ('Pet $deleteid Deleted Successfully', '$dateandtime', '$user')";
            $conn->query($sqlfornotification);
            
            sendJsonResponse(1,"Pet deleted successfully");


        } else {
            sendJsonResponse(2, "Error Deleting pet");
        }
    
    
    } else {
        $sql = "SELECT * FROM pets WHERE user = '$user'";
        $result = $conn->query($sql);
    
        $pets = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pets[] = $row;
            }
        }

        elseif ($result->num_rows == 0) {
            sendJsonResponse(3, "No Pets Found");
        }
    
        echo json_encode($pets);
    }
}
else{
    header('Location: ../login.php');
}


?>