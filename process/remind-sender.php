<?php

include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

date_default_timezone_set('Asia/Colombo');
$currentDate = date('Y/m/d');
$currentTime = date('H:i');
$endTime = date('H:i', strtotime('+5 minutes'));

$sql = "SELECT * FROM reminders WHERE reminder_date = '$currentDate' AND reminder_time BETWEEN '$currentTime' AND '$endTime' AND status = 'active'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $to = $row['email'];
        $subject = "Reminder: " . $row['type'];
        $message = "Dear user,\n\nThis is a reminder for your pet's " . $row['type'] . " scheduled on " . $row['date'] . " at " . $row['time'] . ".\n\nReminder note: " . $row['reminder'] . "\n\nThank you.";
        $headers = "From: noreply@petter.pasanb.me";

        if (mail($to, $subject, $message, $headers)) {
            $updateSql = "UPDATE reminders SET status = 'sent' WHERE id = " . $row['id'];
            $conn->query($updateSql);
        } else {
            echo "Error sending email to: " . $to;
        }
    }
} else {
    echo "No reminders to send at this time.";
}

$conn->close();
?>
