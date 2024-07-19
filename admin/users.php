<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Accounts| Petter</title>
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
                        <h3 class="page-title"  style="margin-top:30px">User Accounts</h3> <br>
                        <?php
                        include "./includes/config.php"; 

                        $vetid = $_SESSION['id'];
                        flashMessage(); 

                        $stmt = $conn->prepare("SELECT * FROM users WHERE user_type = 'user'");
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
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>
                                            <td>' . htmlspecialchars($row["id"]) . '</td>
                                            <td>' . htmlspecialchars($row["name"]) . '</td>
                                            <td>' . htmlspecialchars($row["email"]) . '</td>
                                            <td>' . htmlspecialchars($row["address"]) . '</td>
                                            <td><span class="badge badge-pill p-1 px-2 ' . ($row["status"] == 'active' ? 'badge-success' : 'badge-secondary') . '">' . htmlspecialchars($row["status"]) . '</span></td>
                                            <td>';
                                        if ($row["status"] == 'active') {
                                            echo '<a href="./process/user-management.php?userid=' . htmlspecialchars($row["id"]) . '&action=suspend" class="btn btn-danger btn-sm" style="padding-top:6px;padding-bottom:6px">Suspend</a>';
                                        } else {
                                            echo '<a href="./process/user-management.php?userid=' . htmlspecialchars($row["id"]) . '&action=reactivate" class="btn btn-success btn-sm" style="padding-top:6px;padding-bottom:6px">Reactivate</a>';
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
                                        No User Accounts found.
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
                emptyTable: "No user accounts found.",
                info: "Showing _START_ to _END_ of _TOTAL_ user accounts",
                infoEmpty: "Showing 0 to 0 of 0 user accounts",
                infoFiltered: "(filtered from _MAX_ total user accounts)"
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
