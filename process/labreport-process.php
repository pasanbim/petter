<?php 

include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';
$uploadDir = "../uploads/";


$user = $_SESSION['email'];
$user_id = $_SESSION['id']; 

if ($_SESSION['user_type'] == 'vet') {
    $vet_id = $_SESSION['id'];
}


if(isset($_POST['petid']) && !empty($_POST['petid']) && isset($_POST['labreporttype']) && !empty($_POST['labreporttype']) && isset($_POST['owneremail']) && !empty($_POST['owneremail'])) {

    $petid = $_POST['petid'];
    $labreporttype = $_POST['labreporttype'];
    $owneremail = $_POST['owneremail'];
    $status = "Pending";

    //insert data to labreports table
    $sql = "INSERT INTO labreports (petid, vetid, type, petowneremail,status) VALUES ('$petid', '$vet_id', '$labreporttype', '$owneremail', '$status')";
    $result = mysqli_query($conn, $sql);
    if($result) {
        sendJsonResponse(1, "Lab Report Requested Successfully");
    }
    else {
        sendJsonResponse(0, "Failed to Request Lab Report");
    }  
}


//delete report request
 if(isset($_GET['reportid']) && !empty($_GET['reportid']) && isset($_GET['action']) && $_GET['action'] == 'cancel') {

    $sql = "DELETE FROM labreports WHERE id = '$_GET[reportid]'";
    $result = mysqli_query($conn, $sql);
    if($result) {
        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Report Request Cancelled Successfully'];
        header('Location: ../vet/labreports.php');

    }
    else {
        $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Failed to Cancel Report Request'];
        header('Location: ../vet/labreports.php');
    }

}

//upload report
 if(isset($_POST['reportid']) && !empty($_POST['reportid']) && isset($_POST['action']) && $_POST['action'] == 'upload' && isset($_FILES['labreport']) && !empty($_FILES['labreport'])) {


    $reportid = $_POST['reportid'];
    $report = $_FILES['labreport']['name'];

    $fileTmpPath = $_FILES["labreport"]["tmp_name"];
    $fileName = $_FILES["labreport"]["name"];
    $fileSize = $_FILES["labreport"]["size"];
    $fileType = $_FILES["labreport"]["type"];
    $newFileName = md5(time() . $fileName) . "_" . $fileName;
    $uploadPath = $uploadDir . $newFileName;

    if (!move_uploaded_file($fileTmpPath, $uploadPath)) {

        sendJsonResponse(0, "There was an error moving the uploaded file");
    }
    else{
        $sql = "UPDATE labreports SET report = '$newFileName', status = 'Completed' WHERE id = '$reportid'";
        $result = mysqli_query($conn, $sql);
        if($result){
            sendJsonResponse(1, "Report Uploaded Successfully");
        }
        else {
            sendJsonResponse(0, "Failed to Upload Report");
        }
       
    }
   


}

else {
    // Handle the case where POST data is not set correctly
    $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Invalid Request'];
    if ($_SESSION['user_type'] == 'vet') {
        header('Location: ../vet/labreports.php');
    } else {
        header('Location: ../labreports.php');
    }
    exit();
}
?>