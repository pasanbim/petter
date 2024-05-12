<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard | Petter</title>
</head>

<body class="vertical light">
<?php  include './includes/header.php'; include './includes/sidebar.php'; ?>

  <main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="row align-items-center my-4">
            <div class="col">
              <h3 class="h3 page-title">My Pets</h3>
            </div>
            <div class="col-auto">
              <a href="./onboarding.php" class="btn btn-primary">
                <span class="fe fe-plus fe-12 mr-2"></span>New Pet
              </a>
            </div>
          </div>
          <div class="row">

          <?php 
          
          $user =  $_SESSION['email'];
          $sql = "SELECT * FROM pets WHERE user = '$user'";
          $result = $conn->query($sql);
          if($result -> num_rows > 0){
            while($row = $result -> fetch_assoc()){
              echo '<div class="col-md-3">
              <div class="card shadow mb-4">
                <div class="card-body text-center">
                <div class="row align-items-center justify-content-end">
                    <div class="col-auto">
                      <div class="file-action">
                        <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu m-2">
                          <a class="dropdown-item" href="#">
                            <i class="fe fe-meh fe-12 mr-4 "></i>Profile
                          </a>
                          <a class="dropdown-item" href="#">
                            <i class="fe fe-message-circle fe-12 mr-4"></i>Chat
                          </a>
                          <a class="dropdown-item" href="#">
                            <i class="fe fe-mail fe-12 mr-4"></i>Contact
                          </a>
                          <a class="dropdown-item" href="#">
                            <i class="fe fe-delete fe-12 mr-4"></i>Delete
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="avatar avatar-lg mt-4">
                    <a href="">
                      <img src="./uploads/'.$row['petImage'].'" alt="..." class="avatar-img rounded-circle">
                    </a>
                  </div>
                  <div class="card-text my-2">
                    <strong class="card-title my-0">'.$row['name'].'</strong>
                    <p class="small text-muted mb-0">Accumsan Consulting</p>
                    <p class="small">
                    <span class="badge badge-dark">'.$row['breed'].'</span>
                    <!-- <span class="badge badge-light text-muted">New York, USA</span> -->

                    </p>
                  </div>
                </div>
              </div>
            </div>';
            }
          }
          
          ?>
          </div>
        </div>
      </div>
    </div>
  </main>


<?php include './includes/scripts_include.php'; ?>
</body>

</html>