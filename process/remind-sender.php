<?php

include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';
$logFile = '../process/reminders.log';


function logMessage($message) {
    global $logFile;
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - " . $message . PHP_EOL, FILE_APPEND);
}


date_default_timezone_set('Asia/Colombo');
$currentDate = date('Y/m/d');
$currentTime = date('H:i');
$endTime = date('H:i', strtotime('+5 minutes'));

echo "Current Date: " . $currentDate . "<br>";
echo "Current Time: " . $currentTime . "<br>";

$sql = "SELECT * FROM reminders WHERE reminder_date = '$currentDate' AND reminder_time = '$currentTime' AND status = 'active'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {

        echo $row['id'] . " " . $row['reminder_date'] . " " . $row['reminder_time'] . " " . $row['email'] . " " . $row['type'] . " " . $row['reminder'] . "<br>";
        
        if (reminderemail($row['email'], $row['type'], $row['date'],$row['time'],$row['reminder'])) {
            $updateSql = "UPDATE reminders SET status = 'sent' WHERE id = " . $row['id'];

            if ($conn->query($updateSql) === TRUE) {
                logMessage("Reminder " . $row['id'] . " sent to: " . $to . " and status updated.");
                
            } else {
                logMessage("Error updating status for reminder ID: " . $row['id']);
            }
        } else {
            echo "Error sending email to: " . $to;
        }
    }
} else {
    echo "No reminders to send at this time.";
}

$conn->close();
?>
