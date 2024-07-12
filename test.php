<?php
// Define the upload directory
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/petter/uploads/';

// Define the filename to be deleted
$filename = '59e307a488d226e20a860cc6dfd36c33_bg.jpg';

// Full path to the file
$filePath = $uploadDir . $filename;

// Check if the file exists
if (file_exists($filePath)) {
    // Attempt to delete the file
    if (unlink($filePath)) {
        echo "File '$filename' deleted successfully.";
    } else {
        echo "Error deleting the file '$filename'.";
    }
} else {
    echo "File '$filename' does not exist.";
}
?>
