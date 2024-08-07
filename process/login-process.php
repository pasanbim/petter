<?php 
include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
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
        if ($row['status'] !== 'active') {
            sendJsonResponse(3, "User account is not active");
            
        } else if ($row['status'] == 'active' && password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['user_type'] = $row['user_type'];

            date_default_timezone_set('Asia/Colombo');

            $geoplugin = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
            $city = $geoplugin['geoplugin_city'];
            $country = $geoplugin['geoplugin_countryName'];
            $location = $city . ', ' . $country;

            $ip = $_SERVER['REMOTE_ADDR'];
            $device = detectdevice();
            $time = date('h:i A', time());
            $date = date("Y/m/d");

            if ($row['user_type'] == 'user') {
                loginemail($email, $row['name'], $time, $date, $device, $ip, $location);
                sendJsonResponse(1, "Login successful");
            }
            else if ($row['user_type'] == 'vet') {
                sendJsonResponse(11, "Login successful");
            }
            else if ($row['user_type'] == 'admin') {
                sendJsonResponse(111, "Login successful");
            }
        } else {
            sendJsonResponse(0, "Invalid Credentials");
        }
    } else {
        sendJsonResponse(2, "User not found");
    }
}


if(isset($_POST['userid']) && isset($_POST['action']) && $_POST['action'] == 'deleteaccount') {
    $userid = $_POST['userid'] ?? '';
    $userid = $conn->real_escape_string($userid);

    $sql = "DELETE FROM users WHERE id = '$userid'";
    if ($conn->query($sql) === TRUE) {
        sendJsonResponse(1, "Account deleted successfully");
    } else {
        sendJsonResponse(0, "Error deleting account");
    }
}

?>
