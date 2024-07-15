<?php
// fetch_pets.php

header('Content-Type: application/json');

include '../includes/config.php';

session_start(); // Ensure session is started

$vet_id = $_SESSION['id']; 

// Fetch pet IDs with active or attended appointments for the given vet
$sql = "SELECT DISTINCT petid FROM appointments WHERE vetid = '$vet_id' AND (status = 'active' OR status = 'attended')";
$result = $conn->query($sql);

$petids = array();
while ($row = $result->fetch_assoc()) {
    $petids[] = $row['petid'];
}

if (count($petids) > 0) {
    // Convert array of pet IDs to a comma-separated string
    $petids_str = implode(",", $petids);

    // Query to fetch pet details using JOIN
    $sql = "SELECT p.id, p.name, p.type, p.breed, p.color, p.weight, p.birthday, p.sex, p.socialability, p.petImage, p.allergies, p.user 
            FROM pets p
            WHERE p.id IN ($petids_str)";
    
    $result = $conn->query($sql);
    
    if (!$result) {
        // Query failed, handle error
        echo json_encode(array('error' => 'Query failed: ' . $conn->error));
        exit;
    }

    $pets = array();
    while ($row = $result->fetch_assoc()) {
        $pets[] = $row;
    }

    echo json_encode($pets);
} else {
    echo json_encode(array('message' => 'No pets found'));
}
?>
