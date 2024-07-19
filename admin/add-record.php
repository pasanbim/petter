<?php 

include './includes/config.php';
//getpet info by using pet id
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM pets WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $petName = $row['name'];

    }
    else{
        header('Location: ./pets.php');
    }
    
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Assigned Pets | Petter</title>
    <?php include './includes/cdn_include.php'; ?>
    <link rel="stylesheet" href="./assets/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="./assets/css/daterangepicker.css">

    <script>
    // avoid data submission repeat on refresh
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
                        <h3 class="h3 page-title">Add New Record for <?php echo htmlspecialchars($petName); ?></h3>
                        </div>
                            <div class="col-auto">
                                <a href="./pets.php">
                                <button class="btn btn-primary"
                                    style="margin-top:0 !important; padding: 7px !important">
                                    <span class="fe fe-arrow-left fe-12 mr-2 mb-2"></span>Back to Pets
                                </button>
                                </a>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <form id="recordForm" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="record_type">Record Type</label>
                                                    <select id="recordtype" name="recordtype" class="form-control">
                                                        <option value="vaccination">Vaccination</option>
                                                        <option value="surgery">Surgery</option>
                                                        <option value="allergy">Allergy</option>
                                                        <option value="medication">Medication</option>
                                                        <option value="checkup">Checkup</option>
                                                        <option value="labresult">Lab Result</option>
                                                        <option value="nutrition">Nutrition</option>
                                                        <option value="behavior">Behavior</option>
                                                        <option value="breeding">Breeding</option>
                                                    </select>
                                                </div>
                                                <input type="text" id="petid" name="petid" class="form-control" value="<?php echo $_GET['id']; ?>" hidden>

                                                <div class="form-group col-md-6">
                                                    <label for="date">Date</label>
                                                    <input type="date" id="date" name="date" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="record">Record</label>
                                                    <input type="text" class="form-control" id="record" name="record" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="proof">Proof</label>
                                                    <input class="form-control proof" style="height: unset" type="file" id="proof" name="proof" accept=".jpg, .png, .heic, .jpeg, .pdf">
                                                </div>
                                            </div>
                                            <button data-petid="<?php echo $_GET['id'];?>" class="btn btn-primary btn-addrecord">Add Record</button>
                                        </form>
                                    </div>
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
    <script src='assets/js/jquery.dataTables.min.js'></script>
    <script src='assets/js/dataTables.bootstrap4.min.js'></script>
    <script src="./assets/js/reminders.js"></script>

    <script>
    $(document).on('click', '.btn-addrecord', function(e) {
        e.preventDefault();
        var id = $('#petid').val();
        var recordtype = $('#recordtype').find(":selected").text();
        var date = $('#date').val();
        var record = $('#record').val();
        var proof = $('#proof')[0].files[0];
    
        if (recordtype == '' || date == '' || record == '') {
            erroralert('All fields are required');
            return;
        }
    
        // Convert date to m/d/y format
        var dateParts = date.split('-');
        var formattedDate = dateParts[1] + '/' + dateParts[2] + '/' + dateParts[0];

        var formData = new FormData();
        formData.append('petid', id);
        formData.append('recordtype', recordtype);
        formData.append('date', formattedDate);
        formData.append('record', record);
        formData.append('proof', proof);


        $.ajax({
            url: "../process/pets-process.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {

                if (response.status == 7) {
                    successalert(response.message);
                } 
                else{
                    erroralert(response.message);
                }
            }
        });
    });



    document.addEventListener('DOMContentLoaded', (event) => {
        var today = new Date();
        var day = ("0" + today.getDate()).slice(-2);
        var month = ("0" + (today.getMonth() + 1)).slice(-2);
        var todayDate = today.getFullYear() + "-" + month + "-" + day;
        document.getElementById("date").setAttribute("max", todayDate);
    });
    </script>

    <?php include './includes/scripts_include.php'; ?>
</body>

</html>
