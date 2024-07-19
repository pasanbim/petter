<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Vet Accounts | Petter</title>
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
                        <h3 class="page-title">Pending Vet Accounts</h3> <br>
                        <?php
                        include "./includes/config.php"; 

                        $vetid = $_SESSION['id'];
                        flashMessage(); 

                        $stmt = $conn->prepare("SELECT * FROM users WHERE user_type = 'vet' AND status = 'pending'");
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            echo '<div class="card">
                            <div class="card-body">
                                <table class="table datatable table-bordered" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>License</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>
                                            <td>' . htmlspecialchars($row["id"]) . '</td>
                                            <td> Dr. ' . htmlspecialchars($row["name"]) . '</td>
                                            <td>' . htmlspecialchars($row["email"]) . '</td>
                                            <td>' . htmlspecialchars($row["address"]) . '</td>
                                            <td>' . htmlspecialchars($row["phone"]) . '</td>
                                            <td>' . htmlspecialchars($row["license"]) . '</td>
                                            <td><span class="badge badge-pill p-1 px-2 badge-warning">' . htmlspecialchars($row["status"]) . '</span></td>
                                            <td>
                                                <a href="./process/user-management.php?userid=' . htmlspecialchars($row["id"]) . '&action=approve" class="btn btn-success btn-sm" style="padding-top:6px;padding-bottom:6px">Approve</a>
                                                <a href="./process/user-management.php?userid=' . htmlspecialchars($row["id"]) . '&action=decline" class="btn btn-danger btn-sm" style="padding-top:6px;padding-bottom:6px">Decline</a>
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
                                        No Pending Vet Accounts found.
                                    </div>
                                </div>';
                        }
                        $stmt->close();
                        ?>
                    </div>

                    <div class="col-12">
                        <h3 class="page-title" style="margin-top:30px">Vet Accounts</h3> <br>
                        <?php
                        include "./includes/config.php"; 

                        $vetid = $_SESSION['id'];
                        flashMessage(); 

                        $stmt = $conn->prepare("SELECT * FROM users WHERE user_type = 'vet' AND (status = 'active' OR status = 'inactive') ORDER BY status ASC");
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            echo '<div class="card">
                            <div class="card-body">
                                <table class="table datatable table-bordered" id="dataTable-2">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>License</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>
                                            <td>' . htmlspecialchars($row["id"]) . '</td>
                                            <td> Dr. ' . htmlspecialchars($row["name"]) . '</td>
                                            <td>' . htmlspecialchars($row["email"]) . '</td>
                                            <td>' . htmlspecialchars($row["address"]) . '</td>
                                            <td>' . htmlspecialchars($row["phone"]) . '</td>
                                            <td>' . htmlspecialchars($row["license"]) . '</td>
                                            <td><span class="badge badge-pill p-1 px-2 ' . ($row["status"] == 'active' ? 'badge-success' : 'badge-secondary') . '">' . htmlspecialchars($row["status"]) . '</span></td>
                                            <td>';
                                        if ($row["status"] == 'active') {
                                            echo '<a href="./process/user-management.php?userid=' . htmlspecialchars($row["id"]) . '&action=suspend&user=vet" class="btn btn-danger btn-sm" style="padding-top:6px;padding-bottom:6px">Suspend</a>';
                                        } else {
                                            echo '<a href="./process/user-management.php?userid=' . htmlspecialchars($row["id"]) . '&action=reactivate&user=vet" class="btn btn-success btn-sm" style="padding-top:6px;padding-bottom:6px">Reactivate</a>';
                                        }
                                        echo '</td>
                                        </tr>';
                                    }        
                            echo '</tbody>
                                </table>
                            </div>
                        </div>';
                        } else {
                            echo '<div class="card">
                                    <div class="card-body">
                                        No Vet Accounts found.
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
                emptyTable: "No pending vet accounts found.",
                info: "Showing _START_ to _END_ of _TOTAL_ pending vet accounts",
                infoEmpty: "Showing 0 to 0 of 0 pending vet accounts",
                infoFiltered: "(filtered from _MAX_ total pending vet accounts)"
            },
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            pagingType: "simple_numbers",
            pageLength: 10,
            dom: 'lrtip'
        });
        
        $('#dataTable-2').DataTable({
            autoWidth: true,
            language: {
                emptyTable: "No vet accounts found.",
                info: "Showing _START_ to _END_ of _TOTAL_ vet accounts",
                infoEmpty: "Showing 0 to 0 of 0 vet accounts",
                infoFiltered: "(filtered from _MAX_ total vet accounts)"
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
