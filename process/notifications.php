<?php 

include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {

    $user = $_SESSION['email'];

    if (isset($_POST['loadNotifications']) && $_POST['loadNotifications'] == true) {
        $sql = "SELECT * FROM notifications WHERE user = '$user'";
        $result = $conn->query($sql);
        $notifications = [];
        $numofnotifications = 0;

        if ($result->num_rows > 0) {
            $numofnotifications = $result->num_rows;

            while ($row = $result->fetch_assoc()) {
                $notifications[] = $row;
            }
        }

        $response = [
            'numberofnotifications' => $numofnotifications,
            'notification' => $notifications
        ];

        echo json_encode($response);
    } elseif (isset($_POST['clearNotifications']) && $_POST['clearNotifications'] == true) {
        $sql = "DELETE FROM notifications WHERE user = '$user'";
        $result = $conn->query($sql);
        echo json_encode(['status' => 1]);
    }
}
?>
