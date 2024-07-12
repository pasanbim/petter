<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile | Petter</title>
    <?php include './includes/cdn_include.php'; ?>
    <script>

    // avoid data submision repeat on refresh
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</head>

<body class="vertical light">
    <div class="wrapper">
        <?php include './includes/header.php'; include './includes/sidebar.php'; ?>
        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row align-items-center my-4">
                            <div class="col">
                                <h3 class="h3 page-title">Profile</h3>
                            </div>
                        </div>
                        <div class="card card-fill timeline" id="timeline">
                            <div class="card-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="row mt-5 align-items-center">
                                        <div class="col-md-3 text-center mb-5">
                                            <div class="avatar avatar-xl">
                                                <?php 
                                                $sql = "SELECT * FROM users WHERE email = '".$_SESSION['email']."'";
                                                $result = $conn->query($sql);
                                                $row = $result->fetch_assoc();
                                                if($row['image'] != '') {
                                                    echo '<img src="./assets/avatars/'.$row['image'].'" alt="..." class="avatar-img rounded-circle">';
                                                } else {
                                                    echo '<img src="./assets/images/icon-square.jpg" alt="..." class="avatar-img rounded-circle">';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row align-items-center">
                                                <div class="col-md-7 mb-4">
                                                    <h3 class="mb-1"><?php echo $_SESSION['name']?></h3>
                                                    <p class="small mb-3"><span class="badge badge-primary" style="padding:5px">Free Plan</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" name="name" class="form-control" value="<?php echo $_SESSION['name']?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Email</label>
                                            <input type="text" id="email" name="email" class="form-control" value="<?php echo $_SESSION['email']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //filter name
        
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = $_POST['email'];

        if($name == '' || $email == '' ) {
            echo "<script>location.reload()</script>";
            exit();
        }
        
        $updateProfileQuery = "UPDATE users SET name = '$name', email = '$email' WHERE email = '".$_SESSION['email']."'";
        if ($conn->query($updateProfileQuery) === TRUE) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;

            $dateandtime = date('Y-m-d H:i:s'); // Ensure $dateandtime is set
            $sqlfornotification = "INSERT INTO notifications (message, time, user) VALUES ('Profile Updated Successfully', '$dateandtime', '$email')";
            $conn->query($sqlfornotification);
            
            echo "<script>location.reload()</script>";
        } else {
            echo "<script>erroralert('Error updating profile.')</script>";
        }

        if(isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            $target_dir = "assets/avatars/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                echo "<script>alert('Sorry, your file was not uploaded.')</script>";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $sql = "UPDATE users SET image = '".$_FILES["image"]["name"]."' WHERE email = '".$_SESSION['email']."'";
                    if ($conn->query($sql) === TRUE) {
                        //delete previous image
                        if($row['image'] != '') {
                            unlink($target_dir.$row['image']);
                        }
                        echo "<script>window.location.href = 'profile.php';</script>";
                    } else {
                        echo "<script>erroralert('Sorry, there was an error updating your profile.')</script>";
                    }
                } else {
                    echo "<script>erroralert('Sorry, there was an error uploading your file.')</script>";
                }
            }
        }
    }
    ?>

    <?php include './includes/scripts_include.php'; ?>
</body>

</html>
