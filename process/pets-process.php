<?php 

include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';
$uploadDir = '../uploads/';



date_default_timezone_set('Asia/Colombo');
$dateandtime = date('Y-m-d h:i A', time());



if (isset($_SESSION['email'])) {

    $user = $_SESSION['email'];

    // delete pet

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
    
    
    } 
    // add record

    elseif (isset($_POST['petid']) && !empty($_POST['petid']) && isset($_POST['recordtype']) && !empty($_POST['recordtype']) && isset($_POST['date']) && !empty($_POST['date']) && isset($_POST['record']) && !empty($_POST['record']))
    {
        $petid = $_POST['petid'];
        $recordtype = $_POST['recordtype'];
        $date = $_POST['date'];
        $record = $_POST['record'];
        $newFileName = '';
                
        if (isset($_FILES['proof']) && !empty($_FILES['proof'])) {

            $fileTmpPath = $_FILES['proof']['tmp_name'];
            $fileName = $_FILES['proof']['name'];
            $fileSize = $_FILES['proof']['size'];
            $fileType = $_FILES['proof']['type'];

            $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
            if (in_array($fileType, $allowedFileTypes) && $fileSize < 5000000) { 
                $newFileName = md5(time() . $fileName) . '_' . $fileName;
                $uploadPath = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $uploadPath)) {

                } 
                else 
                {
                    sendJsonResponse(5, "There was an error moving the uploaded file");
                }
            } 
            else 
            {
                sendJsonResponse(6, "Invalid file type or size too large");
            }
            
        }

        $sql = "INSERT INTO records (petid, type, record, proof, added_by, date) VALUES ('$petid', '$recordtype', '$record', '$newFileName', '$user', '$date')";
        if ($conn->query($sql) === TRUE) {
            sendJsonResponse(7, "Record Added Successfully");
        } else {
            sendJsonResponse(8, "Error Adding Record");
        }

    }   
    
    
    
    
    
    else {
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