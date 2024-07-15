<?php 
include './process/functions.php'; 
include './includes/config.php'; 

// if session not started start it
if (session_status() == PHP_SESSION_NONE) {
    session_start();

    if(($_SESSION['user_type'] != 'admin') || ($_SESSION['user_type'] != 'user')) {
        header('Location: ./login.php'); }
    
}

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$redirecturl= $_SERVER['REQUEST_URI'];
sessionvalidation($redirecturl);
?>

<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <ul class="nav">
        <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
                <span class="fe fe-bell fe-16" id="notification-icon"></span>
                <span class="notification-dot dot"></span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                <?php 
                $sql = "SELECT * FROM users WHERE email = '".$_SESSION['email']."'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                if($row['image'] != '') {
                    echo '<img src="./assets/avatars/'.$row['image'].'" alt="..." class="avatar-img rounded-circle" style="display:none;">';
                } else {
                    echo '<img src="./assets/images/icon-square.jpg" alt="..." class="avatar-img rounded-circle" style="display:none;">';
                }
                ?>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="./profile.php">Profile</a>
                <a class="dropdown-item" href="./logout.php">Log Out</a>
            </div>
        </li>
    </ul>
</nav>

<div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush my-n3 notifications-list">
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-box fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong></strong></small>
                                <small class="badge badge-pill badge-light text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-block clear-notifications" data-dismiss="modal">Clear All</button>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Show the avatar image once the page is fully loaded
        $('.avatar-img').show();
    });
</script>
