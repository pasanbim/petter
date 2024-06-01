<?php 
include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

date_default_timezone_set('Asia/Colombo');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && !empty($_POST['email'])) {
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

else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['token']) && !empty($_POST['token']) && isset($_POST['newpassword']) && !empty($_POST['newpassword']) && isset($_POST['confirmpassword']) && !empty($_POST['confirmpassword'])) {
   $newpassword = $_POST['newpassword'] ?? '';
   $confirmpassword = $_POST['confirmpassword'] ?? '';
   $token = $_POST['token'] ?? '';

   if ($newpassword !== $confirmpassword) {
       sendJsonResponse(4, "Passwords do not match");
   }

    else if (!validatePassword($newpassword)) {
         sendJsonResponse(5, "Password must be at least 5 characters long");
    }

    $sql = "SELECT * FROM users WHERE reset_token = '$token' AND reset_expires > NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $email = $row['email'];
        $password = password_hash($newpassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = '$password', reset_token = NULL, reset_expires = NULL WHERE email = '$email'";
        if ($conn->query($sql) === TRUE) {
            sendJsonResponse(1, "Password reset successfully");
        } 
        else {
            sendJsonResponse(2, "Error resetting password");
        }
    } 
    else {
        sendJsonResponse(3, "Invalid or expired token");
    }

    

        
 



}

?>