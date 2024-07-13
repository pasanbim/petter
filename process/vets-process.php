<?php 

include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

$useid = $_SESSION['id'];

if (isset($_POST['GetVetInfo']) && isset($_POST['radius']) && $_POST['GetVetInfo'] == true) {

    $radius = $_POST['radius'];

    // Get user coordinates
    $sqltogetusercoordinates = "SELECT latitude, longitude FROM users WHERE id = '$useid'";
    $result = $conn->query($sqltogetusercoordinates);
    
    if ($result === false) {
        die("Error retrieving user coordinates: " . $conn->error);
    }

    $user = $result->fetch_assoc();
    if ($user) {
        $userlatitude = $user['latitude'];
        $userlongitude = $user['longitude'];
    } else {
        die("User coordinates not found.");
    }

    // Get vet info within the radius
    $sqltogetvetinfo = "
    SELECT *, 
        (6371 * ACOS(
            COS(RADIANS($userlatitude)) * COS(RADIANS(latitude)) * 
            COS(RADIANS(longitude) - RADIANS($userlongitude)) + 
            SIN(RADIANS($userlatitude)) * SIN(RADIANS(latitude))
        )) AS distance
    FROM users  
    WHERE user_type = 'vet'  
    HAVING distance <= $radius
    ORDER BY distance
    ";

    $result = $conn->query($sqltogetvetinfo);
    
    if ($result === false) {
        die("Error retrieving vet info: " . $conn->error);
    }

    $vetinfo = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $vetinfo[] = $row;
        }
    }

    // Include user coordinates in the response
    $response = [
        'user' => [
            'latitude' => $userlatitude,
            'longitude' => $userlongitude
        ],
        'vets' => $vetinfo
    ];

    echo json_encode($response);
}

?>
