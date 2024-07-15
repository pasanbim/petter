<?php
include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';


$user = $_SESSION['email'];
$vet_id = $_SESSION['id']; // Assuming you have the user ID in session

$reminders = "SELECT * FROM appointments WHERE vetid = '$vet_id' AND status = 'active'";
$result = $conn->query($reminders);

if (!$result) {
    // Query failed, handle error
    echo json_encode(array('error' => 'Query failed: ' . $conn->error));
    exit;
}

$events = array();
while ($row = $result->fetch_assoc()) {
    // Combine date and time to create a DateTime object
    $dateTime = DateTime::createFromFormat('Y-m-d h:i A', $row['date'] . ' ' . $row['time']);
    if ($dateTime) {
        $events[] = array(
            'id' => $row['id'],
            'title' => 'Appointment', // Include 24-hour time format in the title
            'start' => $dateTime->format('Y-m-d\TH:i:s') // ISO 8601 format for FullCalendar
        );
    }
}

echo json_encode($events);
?>
