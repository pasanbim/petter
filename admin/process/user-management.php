<?php 

include '../process/send-mail.php'; 
include '../process/functions.php'; 
include '../includes/config.php';

$user_type = $_SESSION['user_type'];

if($user_type == 'admin') {

    $userid = $_GET['userid'];
    $action = $_GET['action'];
    $user = $_GET['user'];

    if($action == 'approve') {
        $sql = "UPDATE users SET status = 'active' WHERE id = '$userid'";
        $conn->query($sql);
        if($conn->affected_rows > 0) {
            $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Vet approved successfully'];
            header('Location: ../vets.php');

        }
        else {
            $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Error approving vet'];
            header('Location: ../vets.php');
        }
    
    }
   else if($action == 'decline') {
        $sql = "UPDATE users SET status = 'inactive' WHERE id = '$userid'";
        $conn->query($sql);
        if($conn->affected_rows > 0) {
            $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Application declined successfully'];
            header('Location: ../vets.php');

        }
        else {
            $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Error declining application'];
            header('Location: ../vets.php');
        }
    
    }
    else if($action == 'suspend') {
        $sql = "UPDATE users SET status = 'inactive' WHERE id = '$userid'";
        $conn->query($sql);
        if($conn->affected_rows > 0) {
            $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Account Suspended successfully'];
            if ($user == 'vet') {
                header('Location: ../vets.php');
            } else {
                header('Location: ../users.php');
            }

        }
        else {
            $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Error suspending'];
            if ($user == 'vet') {
                header('Location: ../vets.php');
            } else {
                header('Location: ../users.php');
            }
        }
    
    }
    else if($action == 'reactivate') {
        $sql = "UPDATE users SET status = 'active' WHERE id = '$userid'";
        $conn->query($sql);
        if($conn->affected_rows > 0) {
            $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Account Reactivated successfully'];
            if ($user == 'vet') {
                header('Location: ../vets.php');
            } else {
                header('Location: ../users.php');
            }

        }
        else {
            $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Error Reactivating Account'];
            if ($user == 'vet') {
                header('Location: ../vets.php');
            } else {
                header('Location: ../users.php');
            }
        }
    
    }
    
    else {
        $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Invalid Action'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);

        

    }
  
}
else {
    sendJsonResponse(0, "You are not authorized to perform this action");
}



?>