<?php

session_start(); 

include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $latitude = $_POST['latitude'] ?? '';
    $longitude = $_POST['longitude'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $license = $_POST['license'] ?? '';
    $password = $_POST['password'] ?? '';
    $otp = $_POST['otp'] ?? null; 

    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $address = $conn->real_escape_string($address);
    $latitude = $conn->real_escape_string($latitude);
    $longitude = $conn->real_escape_string($longitude);
    $phone = $conn->real_escape_string($phone);
    $license = $conn->real_escape_string($license);
    $password = $conn->real_escape_string($password);
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
    $status = 'active';

    if (!validateText($name)) {
        sendJsonResponse(3, "Invalid name");
    }
    if (!validateEmail($email)) {
        sendJsonResponse(4, "Invalid email");
    }

    if (!validatePassword($password)) {
        sendJsonResponse(5, "Password must be at least 5 characters long");
    }

    if (!validateaddress($address)) {
        sendJsonResponse(9, "Please select a valid address");
    }

    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email);
    if ($result->num_rows > 0) {
        sendJsonResponse(8, "Email already exists");
    } else {
        if ($otp === null) {
            $_SESSION['otp'] = rand(pow(10, 5-1), pow(10, 5)-1);
            $_SESSION['otp_email'] = $email;  // Store the email when sending the OTP
            $_SESSION['otp_email'] = $email;  // Store the email when sending the OTP

            if (otpemail($email, $name, $_SESSION['otp'])) {
                sendJsonResponse(6, "sent");
            } else {
                sendJsonResponse(7, "OTP notsent");
            }
        } else {
            $otp = $conn->real_escape_string($otp);
            $user_type = 'vet';

            // Check if the email matches the one stored in the session
            if ($otp == $_SESSION['otp'] && $email == $_SESSION['otp_email']) {
                $sql = "INSERT INTO users (name, email, address, latitude, longitude, phone, license, password, status, user_type) VALUES ('$name', '$email', '$address', '$latitude', '$longitude', '$phone', '$license', '$hashedpassword', '$status', '$user_type')";
                if ($conn->query($sql) === TRUE) {

                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    
                    signupsuccess($email, $name);
                    // sendJsonResponse(1, "Account Pending Approval");
                    sendJsonResponse(1, "Vet Account Created Successfully");
                } else {
                    sendJsonResponse(2, "Error: " . $sql . "<br>" . $conn->error);
                }
            } else {
                sendJsonResponse(0, "Invalid OTP or email mismatch");
            }
        }
    }
}


?>