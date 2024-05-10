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

function validateaddress($address) {
    return preg_match("/^[A-Za-z0-9\s.,-]+$/", $address);
}



function sendJsonResponse($status, $message) {
    header('Content-Type: application/json');
    echo json_encode(['status' => $status, 'message' => $message]);
    exit;
}


function detectdevice(){
  $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
  $isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet")); 
 
    $isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows")); 
    $isAndroid = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "android")); 
    $isIPhone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "iphone")); 
    $isIPad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "ipad")); 
    $isIOS = $isIPhone || $isIPad; 
    
    if($isIOS){ 
        return 'iOS';
    }
    elseif($isAndroid){ 
        return 'Android'; 
    }
    elseif($isWin){ 
        return 'Windows'; 
    }

}
?>