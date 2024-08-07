<?php
include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

$dateandtime = date("Y-m-d h:i A", time());

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vetid']) && isset($_POST['pet']) && isset($_POST['appointment_date']) && isset($_POST['appointment_time']) && isset($_POST['appointment_type']) && isset($_SESSION['email']) && isset($_SESSION['id'])) {
    $vetId = $_POST['vetid'];
    $petId = $_POST['pet'];
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];
    $appointmentType = $_POST['appointment_type'];
    $userId = $_SESSION['id'];
    $userEmail = $_SESSION['email'];
    $status = "active";
    $remindPriorToHours = 6;

    // Function to calculate reminder date and time

    function calculateReminder($appointmentDate, $appointmentTime, $remindPriorToHours) {
        $appointmentDateTime = $appointmentDate . ' ' . $appointmentTime;
    
        $appointment = new DateTime($appointmentDateTime);
    
        $interval = new DateInterval('PT' . $remindPriorToHours . 'H');
        $appointment->sub($interval);
    
        $newDate = $appointment->format('Y/m/d');
        $newTime = $appointment->format('H:i');
    
        return array('date' => $newDate, 'time' => $newTime);
    }


   // Get the vet address
    $sqlForVetAddress = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sqlForVetAddress);
    $stmt->bind_param("i", $vetId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $vetRow = $result->fetch_assoc();
        $address = $vetRow['address'];
        $vetname = $vetRow['name'];
        $vetemail = $vetRow['email'];
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

        $sqlfornotification = "INSERT INTO notifications (message, time, user) VALUES ('You have a New Appointment', '$dateandtime', '$vetemail')";
        $conn->query($sqlfornotification);


        $reminderDateTime = calculateReminder($appointmentDate, $appointmentTime, $remindPriorToHours);
        $reminderDate = $reminderDateTime['date'];
        $reminderTime = $reminderDateTime['time'];
        
        $insert_reminder = "INSERT INTO reminders (petid, type, date, time, reminder, remind_prior_to, reminder_date, reminder_time, email, status) 
        VALUES ('$petId', 'Appointment', '$appointmentDate', '$appointmentTime', 'Appointment with Dr $vetname', '$remindPriorToHours', '$reminderDate', '$reminderTime', '$userEmail', 'active')";
        $conn->query($insert_reminder);

        if($appointmentType === "online") {
            onlineappointmentconfirmationemail($userEmail, $appointmentDate, $appointmentTime, $link);
        } else {
            physicalappointmentconfirmationemail($userEmail, $appointmentDate, $appointmentTime, $address);
        }
        sendJsonResponse(1, "Appointment Booked Successfully");
        sleep(2);
        header("Location: ../appointments.php");
    } else {
        sendJsonResponse(0, "Error in booking appointment: " . $stmt->error);
    }
    
    $stmt->close();
} 

elseif (isset($_GET['cancelid']) && !empty($_GET['cancelid'])) {

    $appointmentId = $_GET['cancelid'];
    $status = "cancelled";


    //getuseremail 
    $sqltogetuseremail = "SELECT * FROM appointments WHERE id = ?";
    $stmttogetuseremail = $conn->prepare($sqltogetuseremail);
    $stmttogetuseremail->bind_param("i", $appointmentId);
    $stmttogetuseremail->execute();
    $resulttogetuseremail = $stmttogetuseremail->get_result();

    if ($resulttogetuseremail && $resulttogetuseremail->num_rows > 0) {
        $row = $resulttogetuseremail->fetch_assoc();
        $useremail = $row['useremail'];
    }

    // Prepare SQL statement for cancelling appointment
    $sql = "UPDATE appointments SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $appointmentId);
    if ($stmt->execute()) {
        if($_SESSION['user_type'] == 'user'){
            header("Location: ../appointments.php");
        }
        elseif($_SESSION['user_type'] == 'vet'){
            appointmentcancellationemail($useremail,$appointmentId);
            header("Location: ../vet/appointments.php");
        }
    }
    $stmt->close();
    
}
elseif (isset($_GET['attendid']) && !empty($_GET['attendid'])) {

    $appointmentId = $_GET['attendid'];
    $status = "attended";


    //getuseremail 
    $sqltogetuseremail = "SELECT * FROM appointments WHERE id = ?";
    $stmttogetuseremail = $conn->prepare($sqltogetuseremail);
    $stmttogetuseremail->bind_param("i", $appointmentId);
    $stmttogetuseremail->execute();
    $resulttogetuseremail = $stmttogetuseremail->get_result();

    if ($resulttogetuseremail && $resulttogetuseremail->num_rows > 0) {
        $row = $resulttogetuseremail->fetch_assoc();
        $useremail = $row['useremail'];
    }

    // Prepare SQL statement for cancelling appointment
    $sql = "UPDATE appointments SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $appointmentId);
    if ($stmt->execute()) {
        if($_SESSION['user_type'] == 'user'){
            header("Location: ../appointments.php");
        }
        elseif($_SESSION['user_type'] == 'vet'){
            vetattendedtoappointmentemail($useremail,$appointmentId);
            header("Location: ../vet/appointments.php");
        }
    }
    $stmt->close();
    
}

else {
    sendJsonResponse(0, "Invalid request");
}
?>