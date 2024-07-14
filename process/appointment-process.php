<?php
include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vetid']) && isset($_POST['pet']) && isset($_POST['appointment_date']) && isset($_POST['appointment_time']) && isset($_SESSION['email'])&& isset($_SESSION['id'])) {
    $vetId = $_POST['vetid'];
    $petId = $_POST['pet'];
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];
    $userId = $_SESSION['id'];
    $userEmail = $_SESSION['email'];
    $status = "active";

    $sql = "INSERT INTO appointments (petid, vetid, userid, useremail, date, time, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiissss", $petId, $vetId, $userId, $userEmail, $appointmentDate, $appointmentTime, $status);
    if ($stmt->execute()) {


        appointmentconfirmationemail($userEmail, $appointmentDate, $appointmentTime);
        sendJsonResponse(1, "Appointment Booked Successfully");
        sleep(2);
        header("Location: ../appointments.php");


    } else {
        sendJsonResponse(0, "Error in booking appointment");
    }
    $stmt->close();
}
else{
    sendJsonResponse(0, "Invalid request");

}
?>
