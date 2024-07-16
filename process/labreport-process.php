<?php 

include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

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

else {
    // Handle the case where POST data is not set correctly
    $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Invalid Request'];
    header('Location: ../vet/labreports.php');
    exit();
}
?>

