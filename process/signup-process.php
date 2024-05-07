<?php

session_start(); 

include '../process/send-mail.php';
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $otp = $_POST['otp'] ?? null; 

    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);


    if ($otp === null) {

        $_SESSION['otp'] = rand(pow(10, 5-1), pow(10, 5)-1);

        if (otpemail($email, $name, $_SESSION['otp'])) {
            $response = [
                'status' => "sent",
            ];
        } else {
            $response = [
                'status' => "notsent",
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);

    } else {
        $otp = $conn->real_escape_string($otp);
        if ($otp == $_SESSION['otp']) {

            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedpassword')";
            if ($conn->query($sql) === TRUE) {
                $response = [
                    'status' => 1,
                    
                ];
            } else {
                $response = [
                    'status' => 2,
                    'message' => "Error: " . $sql . "<br>" . $conn->error
                ];
            }
        } else {
            $response = [
                'status' => 0,
                'message' => "Invalid OTP"
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

?>