<?php 

// Function to validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate text (only alphabetic characters are allowed)
function validateText($text) {
    return preg_match("/^[A-Za-z\s]+$/", $text);
}

// Function to validate password (length check here, add complexity checks as needed)
function validatePassword($password) {
    return strlen($password) >= 5;
}


function sendJsonResponse($status, $message) {
    header('Content-Type: application/json');
    echo json_encode(['status' => $status, 'message' => $message]);
    exit;
}
?>