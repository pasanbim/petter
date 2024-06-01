<?php 
include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

date_default_timezone_set('Asia/Colombo');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    $email = $conn->real_escape_string($email);

    if (!validateEmail($email)) {
        sendJsonResponse(4, "Invalid email");
    }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $token = bin2hex(random_bytes(10));
        $expires_at = date("Y-m-d H:i:s", strtotime('+1 hour')); 

        $sql = "UPDATE users SET reset_token = '$token', reset_expires = '$expires_at' WHERE email = '$email';";
        if ($conn->query($sql) === TRUE) {
            if (passwordresetemail($email, $token)) {
                sendJsonResponse(1, "Reset link sent to your email");
            } 
            else {
                sendJsonResponse(2, "Error generating reset link");
            }

        } 
        else {
            sendJsonResponse(3, "Error generating reset link");
        }
    } else {
        sendJsonResponse(0, "User not found");
    }
}

?>