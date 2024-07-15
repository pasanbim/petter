<?php
include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

$user = $_SESSION['email'];
$user_id = $_SESSION['id']; // Assuming you have the user ID in session

$reminders = "SELECT * FROM reminders WHERE email = '$user' AND status = 'active'";
$result = $conn->query($reminders);

$events = array();
while ($row = $result->fetch_assoc()) {
    // Combine date and time to create a DateTime object
    $dateTime = DateTime::createFromFormat('Y/m/d H:i', $row['reminder_date'] . ' ' . $row['reminder_time']);
    if ($dateTime) {
        $events[] = array(
            'id' => $row['id'],
            'title' => $row['type'], // Include 24-hour time format in the title
            'start' => $dateTime->format('Y-m-d\TH:i:s') // ISO 8601 format for FullCalendar
        );
    }
}

echo json_encode($events);
?>
