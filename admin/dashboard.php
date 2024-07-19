<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard | Petter</title>
    <?php include './includes/cdn_include.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <!-- Include FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/dashboard.css">

    <style>
    .col-md-4 {
        margin-bottom: 0px !important;
    }
    </style>
</head>

<body class="vertical light">
    <div class="wrapper">
        <?php include './includes/header.php'; ?>
        <?php include './includes/sidebar.php'; ?>

        <?php 
        // Database connection
        $useremail = $_SESSION['email'];
        $userid = $_SESSION['id'];

        $sqlforpets = "SELECT * FROM pets";
        $resultforpets = $conn->query($sqlforpets);
        $pet = $resultforpets->fetch_assoc();
        $total_pets = $resultforpets->num_rows > 0 ? $resultforpets->num_rows : 0;

        $sqlforappointments = "SELECT * FROM appointments WHERE status = 'active'";
        $resultforappointments = $conn->query($sqlforappointments);
        $appointments = $resultforappointments->fetch_assoc();
        $total_appointments = $resultforappointments->num_rows > 0 ? $resultforappointments->num_rows : 0;

        $sqlforvets = "SELECT * FROM users WHERE user_type = 'vet' AND status = 'active'";
        $resultforvets = $conn->query($sqlforvets);
        $vet = $resultforvets->fetch_assoc();
        $total_vets = $resultforvets->num_rows > 0 ? $resultforvets->num_rows : 0;
   
    

        $pendingvetapplications = "SELECT * FROM users WHERE user_type = 'vet' AND status = 'pending'";
        $resultforpendingvetapplications = $conn->query($pendingvetapplications);
        $pendingvet = $resultforpendingvetapplications->fetch_assoc();
        $total_pending_vet_applications = $resultforpendingvetapplications->num_rows > 0 ? $resultforpendingvetapplications->num_rows : 0;

        $totalusers = "SELECT * FROM users WHERE user_type = 'user' AND status = 'active'";
        $resultforusers = $conn->query($totalusers);
        $user = $resultforusers->fetch_assoc();
        $total_users = $resultforusers->num_rows > 0 ? $resultforusers->num_rows : 0;

        
        ?>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row align-items-center mb-4">
                            <div class="col">
                                <h3 class="h3 page-title mb-2">Hello <spanclass="welcomename">
                                        <?php echo $_SESSION['name'];?></span>,</h3>
                            </div>
                        </div>
                        <div class="row mb-2 align-items-center">

                            <div class="col-md-12 my-12" style="margin-bottom: 0px !important">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <strong class="card-title">Pending Vet Accounts</strong>
                                                <p class="small mb-0 mt-1">
                                                    <span class="fe fe-12 fe-arrow-up text-success"></span>
                                                    <span class="text-muted" style="font-size:0.85rem"><a
                                                            style="color:#ADB5BD"
                                                            href="./vets.php"><?php echo $total_pending_vet_applications;?></a></span>
                                                </p>
                                            </div>
                                            <div class="col-4 text-right icon-container">
                                                <i class="fe fe-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 my-4" style="margin-bottom: 0px !important">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <strong class="card-title">Total Pets</strong>
                                                <p class="small mb-0 mt-1">
                                                    <span class="fe fe-12 fe-arrow-up text-success"></span>
                                                    <span class="text-muted" style="font-size:0.85rem"><a
                                                            style="color:#ADB5BD"
                                                            href="./pets.php"><?php echo $total_pets;?></a></span>
                                                </p>
                                            </div>
                                            <div class="col-4 text-right icon-container">
                                                <i class="fe fe-gitlab"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 my-4" style="margin-bottom: 0px !important">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <strong class="card-title">Total Vets</strong>
                                                <p class="small mb-0 mt-1">
                                                    <span class="fe fe-12 fe-arrow-up text-success"></span>
                                                    <span class="text-muted" style="font-size:0.85rem"><a
                                                            style="color:#ADB5BD"
                                                            href="./vets.php"><?php echo $total_vets;?></a></span>
                                                </p>
                                            </div>
                                            <div class="col-4 text-right icon-container">
                                                <i class="fe fe-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 my-4" style="margin-bottom: 0px !important">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <strong class="card-title">Total Users</strong>
                                                <p class="small mb-0 mt-1">
                                                    <span class="fe fe-12 fe-arrow-up text-success"></span>
                                                    <span class="text-muted" style="font-size:0.85rem"><a
                                                            style="color:#ADB5BD"
                                                            href="./pets.php"><?php echo $total_users;?></a></span>
                                                </p>
                                            </div>
                                            <div class="col-4 text-right icon-container">
                                                <i class="fe fe-users"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
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
                                            <td>' . htmlspecialchars($row["name"]) . '</td>
                                            <td>' . htmlspecialchars($row["email"]) . '</td>
                                            <td>' . htmlspecialchars($row["address"]) . '</td>
                                            <td>' . htmlspecialchars($row["phone"]) . '</td>
                                            <td>' . htmlspecialchars($row["license"]) . '</td>
                                            <td><span class="badge badge-pill p-1 px-2 badge-warning">' . htmlspecialchars($row["status"]) . '</span></td>
                                            <td>
                                                <a href="./process/user-management.php?userid=' . htmlspecialchars($row["id"]) . '&action=approve" class="btn btn-success btn-sm" style="padding-top:6px;padding-bottom:6px">Approve</a>
                                                <a href="./process/user-management.php?userid=' . htmlspecialchars($row["id"]) . '&action=cancel" class="btn btn-danger btn-sm" style="padding-top:6px;padding-bottom:6px">Cancel</a>
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


                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include './includes/scripts_include.php'; ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: './process/fetch_appointments.php',
            headerToolbar: {
                left: 'today prev,next',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            dayCellClassNames: function(arg) {
                if (arg.date.getTime() === new Date().setHours(0, 0, 0, 0)) {
                    return ['fc-today-remove-highlight'];
                }
                return ['fc-day-inactive'];
            },
            eventClick: function(info) {
                window.location.href = './appointments.php';
            }
        });

        calendar.render();
    });
    </script>
</body>

</html>