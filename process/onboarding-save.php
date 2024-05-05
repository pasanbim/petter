<?php

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
    

    
                    // $to = 'pasantaxila@gmail.com';
                    // $petname = 'Allen';
    
                    // onboardingemail($to, $petname);
                
    
                } else {
                    echo "There was an error moving the uploaded file.";
                }
            } else {
                echo "Invalid file type or size too large.";
            }
        } else {
            echo "Error in uploading file. Error code: " . $_FILES['petImage']['error'];
        }
    } 
    else {
        echo "No file uploaded.";
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

    echo "Name: " . $name . "<br>";
    echo "Type: " . $type . "<br>";
    echo "Breed: " . $breed . "<br>";
    echo "Color: " . $color . "<br>";
    echo "Weight: " . $weight . "<br>";
    echo "Birth Year: " . $birthyear . "<br>";
    echo "Sex: " . $sex . "<br>";
    echo "Social Ability: " . $socialability . "<br>";
    echo "Allergies: " . $allergies . "<br>";



    // // SQL to insert new record
    // $sql = "INSERT INTO pets (fullName, petType, breed, birthday, sex, allergies) VALUES ('$fullName', '$petType', '$breed', '$birthday', '$sex', '$allergies')";

    // if ($conn->query($sql) === TRUE) {
    //     echo "New record created successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
} else {
    // Not a POST request
    echo "Invalid request";
}

?>
