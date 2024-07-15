<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Appointments | Petter</title>
    <?php include "./includes/cdn_include.php"; ?>
    <script>
    // Prevent form resubmission when refreshing the page
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</head>

<body class="vertical light">
    <div class="wrapper">
        <?php include "./includes/header.php"; ?>
        <?php include "./includes/sidebar.php"; ?>
        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h3 class="page-title">Online Appointments</h3> <br>
                        <!-- Fetch appointments from the database -->
                        <?php
                        include "./includes/config.php"; // Database configuration
                        $stmt = $conn->prepare(
                            "SELECT appointments.*, 
                            users.name as vet_name, 
                            users.address as vet_address, 
                            pets.name as pet_name 
                            FROM appointments 
                            
                            LEFT JOIN users ON appointments.vetid = users.id
                            LEFT JOIN pets ON appointments.petid = pets.id
                            WHERE appointments.status = 'active' AND appointments.type = 'online'
                            ORDER BY appointments.date DESC, appointments.time DESC"
                        );
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            echo '<div class="card">
                            <div class="card-body">
                                <table class="table datatable table-bordered" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Pet</th>
                                            <th>Vet</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Link</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>
                                      <td>' .
                                    htmlspecialchars($row["id"]) .
                                    '</td>
                                      <td>' .
                                    htmlspecialchars($row["pet_name"]) .
                                    '</td>
                                      <td>' .
                                    htmlspecialchars($row["vet_name"]) .
                                    '</td>
                                      <td>' .
                                    htmlspecialchars($row["date"]) .
                                    '</td>
                                      <td>' .
                                    htmlspecialchars($row["time"]) .
                                    '</td>
                                      <td><a href="' .
                                    htmlspecialchars($row["link"]) .
                                    '" target="_blank">Join</a></td>
                                      <td> <span class="badge badge-pill p-1 px-2 badge-success" style="color:white">' .
                                    htmlspecialchars($row["status"]) .
                                    '</span></td>
                                      <td>
                                          <a href = "./process/appointment-process.php?cancelid=' . htmlspecialchars($row["id"]) .'" class="btn btn-danger btn-sm" style="padding-top:6px;padding-bottom:6px" data-cancelid="' . htmlspecialchars($row["id"]) .'">Cancel</a>
                                      </td>
                                  </tr>';
                            }
                            echo '</tbody>
                                </table>
                            </div>
                        </div>';
                        } else {
                            echo '<div class="card">
                                    <div class="card-body">
                                        No online appointments found.
                                    </div>
                                </div>';
                        }
                        $stmt->close();
                        ?>
                    </div>





                    <div class="col-12" style="margin-top:30px">
                        <h3 class="page-title">Physical Appointments</h3> <br>
                        <!-- Fetch appointments from the database -->
                        <?php

                        $useremail = $_SESSION['email']; // Get the session user ID
                        include "./includes/config.php"; // Database configuration
                        $stmt = $conn->prepare(
                            "SELECT appointments.*, 
                            users.name as vet_name, 
                            users.address as vet_address, 
                            pets.name as pet_name 
                            FROM appointments 
                            LEFT JOIN users ON appointments.vetid = users.id
                            LEFT JOIN pets ON appointments.petid = pets.id
                            WHERE appointments.status = 'active' AND appointments.useremail = ? AND appointments.type = 'visitvet'
                            ORDER BY appointments.date DESC, appointments.time DESC"
                        );
                        $stmt->bind_param("i", $useremail); // Bind the session user ID
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            echo '<div class="card">
                            <div class="card-body">
                                <table class="table datatable table-bordered" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Pet</th>
                                            <th>Vet</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>
                                      <td>' .
                                    htmlspecialchars($row["id"]) .
                                    '</td>
                                      <td>' .
                                    htmlspecialchars($row["pet_name"]) .
                                    '</td>
                                      <td>' .
                                    htmlspecialchars($row["vet_name"]) .
                                    '</td>
                                      <td>' .
                                    htmlspecialchars($row["date"]) .
                                    '</td>
                                      <td>' .
                                    htmlspecialchars($row["time"]) .
                                    '</td>
                                    <td>' .
                                    htmlspecialchars($row["vet_address"]) .
                                    '</td>
                                      <td> <span class="badge badge-pill p-1 px-2 badge-success" style="color:white">' .
                                    htmlspecialchars($row["status"]) .
                                    '</span></td>
                                      <td>
                                          <a href = "./process/appointment-process.php?cancelid=' . htmlspecialchars($row["id"]) .'" class="btn btn-danger btn-sm" style="padding-top:6px;padding-bottom:6px" data-cancelid="' . htmlspecialchars($row["id"]) .'">Cancel</a>
                                      </td>
                                  </tr>';
                            }
                            echo '</tbody>
                                </table>
                            </div>
                        </div>';
                        } else {
                            echo '<div class="card">
                                    <div class="card-body">
                                        No physical appointments found.
                                    </div>
                                </div>';
                        }
                        $stmt->close();
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php include "./includes/scripts_include.php"; ?>
    <script>
    $(document).ready(function() {
        $('#dataTable-1').DataTable({
            autoWidth: true,
            language: {
                emptyTable: "No appointments found.",
                info: "Showing _START_ to _END_ of _TOTAL_ appointments",
                infoEmpty: "Showing 0 to 0 of 0 appointments",
                infoFiltered: "(filtered from _MAX_ total appointments)"
            },
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            pagingType: "simple_numbers",
            pageLength: 10,
            dom: 'lrtip'
        });
    });
    </script>
</body>

</html>