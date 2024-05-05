<?php

include '../process/send-mail.php'; 
$uploadDir = '../uploads/';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['petImage']) && $_FILES['petImage']['error'] == 0) {
        $fileTmpPath = $_FILES['petImage']['tmp_name'];
        $fileName = $_FILES['petImage']['name'];
        $fileSize = $_FILES['petImage']['size'];
        $fileType = $_FILES['petImage']['type'];

        $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($fileType, $allowedFileTypes) && $fileSize < 5000000) { // Limit file size to 5MB
            $newFileName = md5(time() . $fileName) . '_' . $fileName;
            $uploadPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $uploadPath)) {


                $to = 'pasantaxila@gmail.com';
                $subject = 'Your Pet has been successfully onboarded!';
                $message = 'Thank you for signing up! Your account has been successfully created.';

                // Send email
                if (sendEmail($to, $subject, $message)) {
                    echo 'Email sent successfully!';
                } else {
                    echo 'Failed to send email.';
                }


                echo "File uploaded successfully: $uploadPath";
            } else {
                echo "There was an error moving the uploaded file.";
            }
        } else {
            echo "Invalid file type or size too large.";
        }
    } else {
        echo "Error in uploading file. Error code: " . $_FILES['petImage']['error'];
    }
} else {
    echo "No file uploaded.";
}

?>
