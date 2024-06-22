<?php 

include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';
$user = $_SESSION['email'];




if (isset($_SESSION['email']) && isset($_POST['petid']) && isset($_POST['action']) && $_POST['action'] == "getallreminders") {
    
    $petid = $_POST['petid'];
    $sql = "SELECT * FROM reminders WHERE petid = '$petid' AND email = '$user'";
    $result = $conn->query($sql);
    $reminders = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reminders[] = $row;
        }
        echo json_encode($reminders);
        exit();
    }
    else {
        echo json_encode($reminders);
        exit();;
    }
}

else if (isset($_SESSION['email'])) {
    $user = $_SESSION['email'];

    $petid = $_POST['petid'];
    $reminder = $_POST['reminder'];
    $reminder_type = $_POST['reminder_type'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $action = $_POST['action'];
    $reminderDate = $_POST['reminderDate'];
    $reminderTime = $_POST['reminderTime'];
    $remindpriorto = $_POST['reminder_prior_to'];
    $status = "active";

    if (isset($petid) && !empty($petid) && isset($reminder_type) && !empty($reminder_type) 
        && isset($date) && !empty($date) && isset($time) && !empty($time) && isset($action) && !empty($action)&& isset($reminderDate) && !empty($reminderDate)&& isset($reminderTime) && !empty($reminderTime)&& isset($remindpriorto) && !empty($remindpriorto)) {

        $check_pet = "SELECT * FROM pets WHERE id = '$petid' AND user = '$user'";
        $check_pet_result = mysqli_query($conn, $check_pet);

        if (mysqli_num_rows($check_pet_result) > 0) {

            $insert_reminder = "INSERT INTO reminders (petid, type, date, time, reminder, remind_prior_to, reminder_date, reminder_time, email, status) VALUES ('$petid', '$reminder_type', '$date', '$time', '$reminder','$remindpriorto','$reminderDate', '$reminderTime', '$user', '$status')";
            $insert_reminder_result = mysqli_query($conn, $insert_reminder);

            if ($insert_reminder_result) {

                $sqlfornotification = "INSERT INTO notifications (message, time, user) VALUES ('Reminder Scheduled Successfully', NOW(), '$user')";
                $conn->query($sqlfornotification);
                sendJsonResponse(1, "Reminder Scheduled Successfully. You will be reminded on $reminderDate at $reminderTime");
                exit();
            }

            else {
                sendJsonResponse(2, "Failed to Add Reminder");
                exit();
            }

        }

        else {
            sendJsonResponse(3, "Invalid Pet");
            exit();
        }

    }
    else{
        sendJsonResponse(4, "All fields are required");
        exit();
    
    }
}

else {
    header("Location: ../login.php");
}



    




?>