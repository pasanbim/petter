<?php
include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

// Check if the form was submitted and all necessary fields are present
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vetid']) && isset($_POST['pet']) && isset($_POST['appointment_date']) && isset($_POST['appointment_time']) && isset($_POST['appointment_type']) && isset($_SESSION['email']) && isset($_SESSION['id'])) {
    $vetId = $_POST['vetid'];
    $petId = $_POST['pet'];
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];
    $appointmentType = $_POST['appointment_type'];
    $userId = $_SESSION['id'];
    $userEmail = $_SESSION['email'];
    $status = "active";


    //get the vet address 
    $sql = "SELECT address FROM vets WHERE id = $vetId";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $address = $row['address'];

 



    // Generate a unique meeting link for online appointments
    $uniqueMeetingId = uniqid('petter-');
    $link = $appointmentType === "online" ? "https://meet.jit.si/" . $uniqueMeetingId : "";

    // Prepare SQL statement for inserting appointment details
    $sql = "INSERT INTO appointments (unique_id, petid, vetid, userid, useremail, date, time, type, link, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        sendJsonResponse(0, "Failed to prepare the database statement");
        exit;
    }
    
    $stmt->bind_param("siiissssss", $uniqueMeetingId, $petId, $vetId, $userId, $userEmail, $appointmentDate, $appointmentTime, $appointmentType, $link, $status);
    if ($stmt->execute()) {
        if($appointmentType === "online") {
            onlineappointmentconfirmationemail($userEmail, $appointmentDate, $appointmentTime, $link);
        }
        else {
            physicalappointmentconfirmationemail($userEmail, $appointmentDate, $appointmentTime,$address);
        }
        sendJsonResponse(1, "Appointment Booked Successfully");
        sleep(2);
        header("Location: ./appointments.php");
    } else {
        sendJsonResponse(0, "Error in booking appointment: " . $stmt->error);
    }
    
    // Close the statement
    $stmt->close();
} else {
    sendJsonResponse(0, "Invalid request");
}
?>
