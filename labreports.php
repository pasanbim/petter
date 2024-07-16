<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lab Report Requests | Petter</title>
    <?php include './includes/cdn_include.php'; ?>
</head>

<body class="vertical light">
    <div class="wrapper">
        <?php include './includes/header.php'; include './includes/sidebar.php'; ?>
        <main role="main" class="main-content">
            <div class="container-fluid">
                <!-- Upload Record -->
                <div class="modal fade" id="uploadreportmodal" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title uploadreportmodaltitle" id="verticalModalTitle">Upload Lab Report</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="labreport">Lab Report</label>
                                        <input type="file" class="form-control" style="height: unset" id="labreport" name="labreport">
                                    </div>
                                    <button class="btn btn-primary btn-uploadreportbutton" id="btn-uploadreportbutton" style="margin-left:5px">
                                        <span class='fe fe-upload fe-12 mr-2 mb-2'></span>Upload Report
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row align-items-center my-4">
                            <div class="col">
                                <h3 class="h3 page-title">Lab Report Requests</h3>
                            </div>
                        </div>
                        <?php
                        flashMessage();

                        $user_email = $_SESSION['email'];
                        $user_id = $_SESSION['id']; 

                        function getPetName($conn, $petid) {
                            $sql = "SELECT name FROM pets WHERE id = '$petid'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                return $row['name'];
                            }
                            return '';
                        }

                        $sql = "SELECT * FROM labreports WHERE petowneremail = '$user_email' ORDER BY status DESC";
                        $result = mysqli_query($conn, $sql);
                        $button = '';
                        if(mysqli_num_rows($result) > 0) {
                            echo '<div class="card card-fill timeline" id="timeline">
                                <div class="card-body">
                                    <table class="table datatables table-bordered" id="reporttable">
                                        <thead>
                                            <tr>
                                                <th>Request ID</th>
                                                <th>Pet ID</th>
                                                <th>Pet Name</th>
                                                <th>Report Type</th>
                                                <th>Status</th>
                                                <th width="10%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                            while($row = mysqli_fetch_assoc($result)) {
                                $statusBadgeClass = '';
                                $reportid = $row['id'];
                                $petid = $row['petid'];
                                $petowneremail = $row['petowneremail'];
                                $labreporttype = $row['type'];
                                $report = $row['report'];
                                $status = $row['status'];
                                $petname = getPetName($conn, $petid);

                                if ($row['status'] == 'Pending') {
                                    $statusBadgeClass = 'badge-primary';
                                } elseif ($row['status'] == 'Completed') {
                                    $statusBadgeClass = 'badge-success';
                                } else {
                                    $statusBadgeClass = 'badge-secondary'; 
                                }

                                if($row['report'] == '') {
                                    $button = "<a data-reportid='$reportid' data-reporttype = '$labreporttype' data-toggle='modal' data-target='#uploadreportmodal' class='btn btn-success upload-button' style='background-color:#FF7C00 !important; color:white'>
                                        <span class='fe fe-upload fe-12 mr-2 mb-2'></span>Upload</a>";
                                } else {
                                    $button = "<a href='./uploads/$report' class='btn btn-success' target='_blank' style=' color:white'>
                                        <span class='fe fe-eye fe-12 mr-2 mb-2'></span>Preview</a>";
                                }
                                echo "<tr>";
                                echo "<td>$reportid</td>";
                                echo "<td>$petid</td>";
                                echo "<td>$petname</td>";
                                echo "<td>$labreporttype</td>";
                                echo '<td><span class="badge badge-pill p-1 px-2 ' . $statusBadgeClass . '" style="color:white;">' . $row['status'] . '</span></td>';
                                echo "<td>$button</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo '<div class="card">
                                <div class="card-body">
                                    No lab report requests found
                                </div>
                            </div>';
                        }
                        ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#reporttable tbody').on('click', '.upload-button', function () {
            var reportid = $(this).data('reportid');
            $('#btn-uploadreportbutton').data('reportid', reportid);
        });

        $('#btn-uploadreportbutton').click(function () {
            var reportid = $(this).data('reportid');
            var labreport = $('#labreport')[0].files[0]; // Get the file

            if (!labreport) {
                alert('Please select a file to upload.');
                return;
            }

            var formData = new FormData();
            formData.append('reportid', reportid);
            formData.append('labreport', labreport);
            formData.append('action', 'upload');

            $.ajax({
                url: './process/labreport-process.php',
                type: 'POST',
                data: formData,
                processData: false, 
                contentType: false, 
                success: function (response) {
                    if(response.status == 1) {
                        successalert(response.message);
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else {
                        erroralert(response.message);
                    }
                   
                }
            });
        });
    });
</script>


<?php include './includes/scripts_include.php'; ?>
</body>

</html>
