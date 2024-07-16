<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lab Report Requests | Petter</title>
    <?php include './includes/cdn_include.php'; 
    ?>

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
                                <h3 class="h3 page-title">Lab Report Requests</h3>
                            </div>
                        </div>
                        <div class="card card-fill timeline" id="timeline">
                            <div class="card-body">
                                <table class="table datatables table-bordered" id="petsTable">
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
                                    <tbody>

                                    <?php
                                    flashMessage();

                                    $vet_email = $_SESSION['email'];
                                    $vet_id = $_SESSION['id']; 

                                    function getPetName($conn, $petid) {
                                        $sql = "SELECT name FROM pets WHERE id = '$petid'";
                                        $result = mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($result) > 0) {
                                            $row = mysqli_fetch_assoc($result);
                                            return $row['name'];
                                        }
                                    }

 
                                    
                                
                                    $sql = "SELECT * FROM labreports WHERE vetid = '$vet_id' ORDER BY status DESC";
                                    $result = mysqli_query($conn, $sql);
                                    $button = '';
                                    if(mysqli_num_rows($result) > 0) {
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
                                                $button = "<a href='../process/labreport-process.php?reportid=$reportid&action=cancel' class='btn btn-danger' style='background-color:#FF7C00 !important'><span class='fe fe-x fe-12 mr-2 mb-2'></span>Cancel</a>";
                                            }
                                            else {
                                                $button = "<a href='../uploads/$report' class='btn btn-success'><span class='fe fe-eye fe-12 mr-2 mb-2'></span>Preview</a>";

                                            }
                                            echo "<tr>";
                                            echo "<td>$reportid</td>";
                                            echo "<td>$petid</td>";
                                            echo "<td>$petname</td>";
                                            echo "<td>$labreporttype</td>";
                                            echo '<td><span class="badge badge-pill p-1 px-2 ' . $statusBadgeClass . '" style="color:white;">' . $row['status'] . '</span></td>';
                                            echo "<td>
                                            
                                                 $button
                                                 
                                                 </td>";

                                            echo "</tr>";
                                        }
                                    }
                                    
                                    ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>


    <?php include './includes/scripts_include.php'; ?>
</body>

</html>