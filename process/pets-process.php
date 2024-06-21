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

    // edit pet
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'editpet') {

        if (
            isset($_POST['name']) && !empty($_POST['name']) &&
            isset($_POST['petid']) && !empty($_POST['petid']) &&
            isset($_POST['type']) && !empty($_POST['type']) &&
            isset($_POST['breed']) && !empty($_POST['breed']) &&
            isset($_POST['color']) && !empty($_POST['color']) &&
            isset($_POST['weight']) && !empty($_POST['weight']) &&
            isset($_POST['birthday']) && !empty($_POST['birthday']) &&
            isset($_POST['sex']) && !empty($_POST['sex']) &&
            isset($_POST['socialability']) && !empty($_POST['socialability'])
        ) {
            $name = $_POST['name'];
            $petid = $_POST['petid'];
            $type = $_POST['type'];
            $breed = $_POST['breed'];
            $color = $_POST['color'];
            $weight = $_POST['weight'];
            $birthday = $_POST['birthday'];
            $sex = $_POST['sex'];
            $socialability = $_POST['socialability'];
    
    
            if (isset($_FILES['petImage']) && $_FILES['petImage']['error'] == 0) {
                $fileTmpPath = $_FILES['petImage']['tmp_name'];
                $fileName = $_FILES['petImage']['name'];
                $fileSize = $_FILES['petImage']['size'];
                $fileType = $_FILES['petImage']['type'];
    
                $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (in_array($fileType, $allowedFileTypes) && $fileSize < 5000000) {
                    $newFileName = md5(time() . $fileName) . '_' . $fileName;
                    $uploadPath = $uploadDir . $newFileName;
    
                    if (!move_uploaded_file($fileTmpPath, $uploadPath)) {
                        sendJsonResponse(0, "There was an error moving the uploaded file");
                    }
                } else {
                    sendJsonResponse(2, "Invalid file type or size too large");
                }
            } else {
                $newFileName = $_POST['existingpetimage'];
            }
    
            $sql = "UPDATE pets SET name = '$name', type = '$type', breed = '$breed', color = '$color', weight = '$weight', birthday = '$birthday', sex = '$sex', socialability = '$socialability', petImage = '$newFileName' 
                    WHERE id = '$petid' AND user = '$user'";
            if ($conn->query($sql) === TRUE) {
                $sqlfornotification = "INSERT INTO notifications (message, time, user) VALUES ('Pet $petid Updated Successfully', '$dateandtime', '$user')";
                $conn->query($sqlfornotification);
    
                sendJsonResponse(1, "Pet Updated Successfully");
            } else {
                sendJsonResponse(3, "Error Updating Pet");
            }
        } else {
            sendJsonResponse(4, "All fields are required");
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

        $sql = "INSERT INTO records (petid, type, record, proof, user,addedby, date) VALUES ('$petid', '$recordtype', '$record', '$newFileName', '$user', 'you', '$date')";
        if ($conn->query($sql) === TRUE) {

            $sqlfornotification = "INSERT INTO notifications (message, time, user) VALUES ('New Record Added Successfully', '$dateandtime', '$user')";
            $conn->query($sqlfornotification);
            
            sendJsonResponse(7, "Record Added Successfully");
        } else {
            sendJsonResponse(8, "Error Adding Record");
        }

    }   
    
    
    
    
    
    else {
        $sql = "SELECT * FROM pets WHERE user = '$user' ORDER BY id ASC";
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