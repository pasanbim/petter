<?php 

session_start(); 

include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    if (!validateEmail($email)) {
        sendJsonResponse(4, "Invalid email");
    }


    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {

            $_SESSION['email'] = $email;
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];



            $ip = $_SERVER['REMOTE_ADDR'];
            $device = detectdevice();
            $time = date('h:i A', time());
            $date = date("Y/m/d");

            loginemail($email, $_SESSION['name'], $time, $date, $device, $ip);
            
            sendJsonResponse(1, "Login successful");
        } else {
            sendJsonResponse(0, "Invalid Credentials");
        }
    } else {
        sendJsonResponse(2, "User not found");
    }

 }

?>