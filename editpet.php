<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Pet | Petter</title>
    <?php ob_start(); include './includes/cdn_include.php';  ?>

</head>

<body class="vertical light">
    <div class="wrapper">
        <?php include './includes/header.php'; include './includes/sidebar.php'; ?>

        <?php

        $petid = $_GET['id'];
        $sql = "SELECT * FROM pets WHERE id = '$petid'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            header("Location: ./pets.php");
            exit();
        }
        $row = $result->fetch_assoc();
        
        ?>

        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="" alt="Pet Image" id="modalImage" class="modal-img" style="max-width: 100%;">
                    </div>
                </div>
            </div>
        </div>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row align-items-center my-4">
                            <div class="col">
                                <h3 class="h3 page-title">Edit Pet</h3>
                            </div>
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                    <form action="" method="POST">

                                        <div class="form-group mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" class="form-control"
                                                value="<?php echo $row["name"]; ?>">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="type">Type</label>
                                            <select class="form-control" id="type">
                                                <option value="dog" <?php if($row["type"] == "dog") echo "selected"; ?>>Dog</option>
                                                <option value="cat" <?php if($row["type"] == "cat") echo "selected"; ?>>Cat</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="breed">Breed</label>
                                            <input type="text" id="breed" class="form-control" value="<?php echo $row["breed"]; ?>">
                                        </div>
 
                                        <div class="form-group mb-3">
                                            <label for="color">Color</label>
                                            <input type="text" id="color" class="form-control" value="<?php echo $row["color"]; ?>">
                                        </div>

                                        </div>  
                                        <div class="col-md-6">

                                        <div class="form-group mb-3">
                                            <label for="weight">Weight</label>
                                            <input type="text" id="weight" class="form-control" value="<?php echo $row["weight"]; ?>">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="birthday">Birthday</label>
                                            <input type="text" id="birthday" class="form-control" value="<?php echo $row["birthday"]; ?>">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="sex">Sex</label>
                                            <select class="form-control" id="sex">
                                                <option value="male" <?php if($row["sex"] == "male") echo "selected"; ?>>Male</option>
                                                <option value="female" <?php if($row["sex"] == "female") echo "selected"; ?>>Female</option>
                                            </select>
                                        </div>

                                        <?php $socialabilityOptions = ["Social", "Tolerant", "Selective", "Aggressive"]; ?>
                                        <div class="form-group mb-3">
                                            <label for="socialability">Socialability</label>
                                            <select class="form-control" id="socialability">
                                                <?php foreach($socialabilityOptions as $option): ?>
                                                <option value="<?php echo $option; ?>"<?php if($row["socialability"] == $option) echo "selected"; ?>><?php echo $option; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        
                                    </form>   
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="image">Pet Image &nbsp;</label>
                                    <i class="fe fe-eye petimagepreview" style="cursor: pointer;"></i>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="image">
                                        <label class="custom-file-label" for="petImage">Choose file</label>
                                    </div>
                                </div>  
                                <input type="text" id="existingpetimage" hidden class="form-control" value="<?php echo $row["petImage"]; ?>">
                                <input type="text" id="petid" hidden class="form-control" value="<?php echo $petid ?>">


                                <button type="submit" class="btn btn-primary editpet mb-3">
                                    <span class="spinner-border spinner-border-sm" id ="spinner" role="status" aria-hidden="true" style="display: none;"></span>
                                    <span class="button-text">Update Pet</span>
                               </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>



    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src='assets/js/daterangepicker.js'></script>
    <script src='assets/js/jquery.timepicker.js'></script>

    <script>

        
    $(document).ready(function() {
        $('.petimagepreview').click(function() {
            const modalImage = $('#modalImage');
            modalImage.attr('src', '<?php echo "./uploads/" . $row['petImage']; ?>');
            $('#imageModal').modal('show');
        });

        $('#customFile').on('change', function(e) {

            const fileName = e.target.files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        });
    });

    $('.drgpicker').daterangepicker({
        singleDatePicker: true,
        timePicker: false,
        showDropdowns: true,
        maxDate: moment(),
        locale: {
            format: 'MM/DD/YYYY'
        }
    });

    $('.time-input').timepicker({
        scrollDefault: 'now',
        zindex: '9999',
        interval: 15,
        defaultTime: '11.30PM',
    });
    </script>

    <?php include './includes/scripts_include.php'; ?>

</body>

</html>