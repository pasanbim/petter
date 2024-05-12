<?php
session_start(); 
include '../process/send-mail.php'; 
include '../includes/config.php'; 
$uploadDir = '../uploads/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['petImage']) && $_FILES['petImage']['error'] == 0) {
            $fileTmpPath = $_FILES['petImage']['tmp_name'];
            $fileName = $_FILES['petImage']['name'];
            $fileSize = $_FILES['petImage']['size'];
            $fileType = $_FILES['petImage']['type'];
    
            $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($fileType, $allowedFileTypes) && $fileSize < 5000000) { 
                $newFileName = md5(time() . $fileName) . '_' . $fileName;
                $uploadPath = $uploadDir . $newFileName;
    
                if (move_uploaded_file($fileTmpPath, $uploadPath)) {

                } else {
                    echo "There was an error moving the uploaded file";
                    exit;
                }
            } else {
                echo "Invalid file type or size too large";
                exit;
            }
        } else {
            echo "Error in uploading file";
            exit;
        }
    } 
    else {
        echo "No file uploaded";
        exit;
    }


    $name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
    $type = isset($_POST['type']) ? $conn->real_escape_string($_POST['type']) : '';
    $breed = isset($_POST['breed']) ? $conn->real_escape_string($_POST['breed']) : '';
    $color = isset($_POST['color']) ? $conn->real_escape_string($_POST['color']) : '';
    $weight = isset($_POST['weight']) ? $conn->real_escape_string($_POST['weight']) : '';
    $birthyear = isset($_POST['birthyear']) ? $conn->real_escape_string($_POST['birthyear']) : '';
    $sex = isset($_POST['sex']) ? $conn->real_escape_string($_POST['sex']) : '';
    $socialability = isset($_POST['socialability']) ? $conn->real_escape_string($_POST['socialability']) : ''; 

    if (isset($_POST['allergies']) && is_array($_POST['allergies'])) {
        $allergyArray = array_map(function($item) use ($conn) {
            return $conn->real_escape_string($item);
        }, $_POST['allergies']);
        $allergies = implode(',', $allergyArray);
    }
    else {
        $allergies = '';
    }
   $user = $_SESSION['email'];
   $username = $_SESSION['name'];


    $sql = "INSERT INTO pets (name, type, breed, color, weight, birthday, sex, socialability, petImage, allergies, user) 
           VALUES ('$name', '$type', '$breed', '$color', '$weight', '$birthyear', '$sex', '$socialability', '$newFileName', '$allergies', '$user')";

    if ($conn->query($sql) === TRUE) {
        
        echo "Pet onboarded successfully";
        onboardingemail($username,$user, $name);
    

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

} else {
    // Not a POST request
    echo "Invalid request";
}

?>