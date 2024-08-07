<?php 

session_start();

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
    return preg_match("/^[A-Za-z0-9\s.,-]{10,}$/", $address);
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


function sessionvalidation($redirect){
    if (!isset($_SESSION['email']) || !isset($_SESSION['name'])) {
        header("Location: ./login.php?redirect=$redirect");
    }
}

//function to display flash message
function flashMessage() {
    if (isset($_SESSION['flash_message'])) {
        $flash = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']); 

        $type = $flash['type'];
        $message = $flash['message'];

        if ($type == 'success') {
            echo "<script>successalert('$message')</script>";
        } else {
            echo "<script>erroralert('$message')</script>";
        }
    }
}


?>