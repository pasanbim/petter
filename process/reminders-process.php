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

//fetch reminder details using reminder id
if (isset($_SESSION['email']) && isset($_POST['reminderid'])  && !empty ($_POST['reminderid']) && isset($_POST['action']) && $_POST['action'] == "get") {
    
    $reminderid = $_POST['reminderid'];
    $sql = "SELECT * FROM reminders WHERE id = '$reminderid' AND email = '$user'";
    $result = $conn->query($sql);
    $reminders = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reminderdetails[] = $row;
        }
        echo json_encode($reminderdetails);
        exit();
    }
    else {
        echo json_encode($reminderdetails);
        exit();;
    }
}


//update reminder details

else if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['action'], $_POST['reminderid'], $_POST['reminder'], $_POST['reminder_type'], $_POST['date'], $_POST['time'], $_POST['reminder_prior_to'], $_POST['reminderDate'], $_POST['reminderTime']) &&
    $_POST['action'] === 'update' &&
    !empty($_POST['reminderid']) &&
    !empty($_POST['reminder']) &&
    !empty($_POST['reminder_type']) &&
    !empty($_POST['date']) &&
    !empty($_POST['time']) &&
    !empty($_POST['reminder_prior_to']) &&
    !empty($_POST['reminderDate']) &&
    !empty($_POST['reminderTime'])) {

    $reminderid = $_POST['reminderid'];
    $reminder = $_POST['reminder'];
    $reminder_type = $_POST['reminder_type'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $reminderDate = $_POST['reminderDate'];
    $reminderTime = $_POST['reminderTime'];
    $remindpriorto = $_POST['reminder_prior_to'];


    $update_reminder = "UPDATE reminders SET
    type = '$reminder_type',
    date = '$date',
    time = '$time',
    reminder = '$reminder',
    remind_prior_to = '$remindpriorto',
    reminder_date = '$reminderDate',
    reminder_time = '$reminderTime',
    email = '$user'
WHERE id = '$reminderid' AND email = '$user'";
    $update_reminder_result = mysqli_query($conn, $update_reminder);

    if ($update_reminder_result) {
        sendJsonResponse(1, "Reminder Updated Successfully");
        exit();
    } else {
        sendJsonResponse(2, "Failed to Update Reminder".mysqli_error($conn));
        
        exit();
    }


   

    
} 


elseif (isset($_SESSION['email']) && isset($_POST['reminderid']) && isset($_POST['reminderid']) && $_POST['action'] == "delete") {
    $reminderid = $_POST['reminderid'];
    $sql = "DELETE FROM reminders WHERE id = '$reminderid' AND email = '$user'";
    if ($conn->query($sql)) {
        sendJsonResponse(1, "Reminder Deleted Successfully");
        exit();
    }
    else {
        sendJsonResponse(2, "Failed to Delete Reminder");
        exit();
    }
}

elseif (isset($_SESSION['email'])) {
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
        && isset($date) && isset($time) && !empty($time) && isset($action) && !empty($action)&& isset($reminderDate) && !empty($reminderDate)&& isset($reminderTime) && !empty($reminderTime)&& isset($remindpriorto) && !empty($remindpriorto)) {

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