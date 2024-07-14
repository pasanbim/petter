<?php
include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vetid']) && isset($_POST['pet']) && isset($_POST['appointment_date']) && isset($_POST['appointment_time']) && isset($_POST['appointment_type']) && isset($_SESSION['email']) && isset($_SESSION['id'])) {
    $vetId = $_POST['vetid'];
    $petId = $_POST['pet'];
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];
    $appointmentType = $_POST['appointment_type'];
    $userId = $_SESSION['id'];
    $userEmail = $_SESSION['email'];
    $status = "active";

   // Get the vet address
    $sqlForVetAddress = "SELECT address FROM users WHERE id = ?";
    $stmt = $conn->prepare($sqlForVetAddress);
    $stmt->bind_param("i", $vetId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $vetRow = $result->fetch_assoc();
        $address = $vetRow['address'];
    }
    $stmt->close();

    // Generate a unique meeting link for online appointments
    $uniqueMeetingId = uniqid('petter-');
    $link = $appointmentType === "online" ? "https://meet.jit.si/" . $uniqueMeetingId : "";

    // Prepare SQL statement for inserting appointment details
    $sql = "INSERT INTO appointments (unique_id, petid, vetid, userid, useremail, date, time, type, link, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        sendJsonResponse(0, "");
        exit;
    }
    
    $stmt->bind_param("siiissssss", $uniqueMeetingId, $petId, $vetId, $userId, $userEmail, $appointmentDate, $appointmentTime, $appointmentType, $link, $status);
    if ($stmt->execute()) {
        if($appointmentType === "online") {
            onlineappointmentconfirmationemail($userEmail, $appointmentDate, $appointmentTime, $link);
        } else {
            physicalappointmentconfirmationemail($userEmail, $appointmentDate, $appointmentTime, $address);
        }
        sendJsonResponse(1, "Appointment Booked Successfully");
        sleep(2);
        header("Location: ./appointments.php");
    } else {
        sendJsonResponse(0, "Error in booking appointment: " . $stmt->error);
    }
    
    $stmt->close();
} else {
    sendJsonResponse(0, "Invalid request");
}
?>