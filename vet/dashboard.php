<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Vet Dashboard | Petter</title>
    <?php include './includes/cdn_include.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <!-- Include FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/dashboard.css">

    <style>

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

        $sqlforpets = "SELECT * FROM pets WHERE user = '$useremail'";
        $resultforpets = $conn->query($sqlforpets);
        $pet = $resultforpets->fetch_assoc();
        $total_pets = $resultforpets->num_rows > 0 ? $resultforpets->num_rows : 0;

        $sqlforappointments = "SELECT * FROM appointments WHERE vetid = '$userid' AND status = 'active'";
        $resultforappointments = $conn->query($sqlforappointments);
        $appointments = $resultforappointments->fetch_assoc();
        $total_appointments = $resultforappointments->num_rows > 0 ? $resultforappointments->num_rows : 0;

        $sqlforreminders = "SELECT * FROM reminders WHERE email = '$useremail' AND status = 'active'";
        $resultforreminders = $conn->query($sqlforreminders);
        $reminders = $resultforreminders->fetch_assoc();
        $total_reminders = $resultforreminders->num_rows > 0 ? $resultforreminders->num_rows : 0;
        ?>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row align-items-center mb-2">
                            <div class="col">
                                <h3 class="h3 page-title">Hello <span class="welcomename">Dr. <?php echo $_SESSION['name'];?></span>,</h3>
                            </div>
                        </div>
                        <div class="row mb-2 align-items-center">
                            <div class="col-md-12 my-4">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <strong class="card-title">Your Active Appointments</strong>
                                                <p class="small mb-0 mt-1">
                                                    <span class="fe fe-12 fe-arrow-up text-success"></span>
                                                    <span class="text-muted" style="font-size:0.85rem"><a
                                                            style="color:#ADB5BD"
                                                            href="./appointments.php"><?php echo $total_appointments;?></a></span>
                                                </p>
                                            </div>
                                            <div class="col-4 text-right icon-container">
                                                <i class="fe fe-calendar"></i>
                                            </div>
                                        </div> <!-- /. row -->
                                    </div> <!-- /. card-body -->
                                </div> <!-- /. card -->
                            </div>
                        </div>
                        <h3 class="h3 page-title mb-4"> Appointment Schedule</h3>
                        <!-- Calendar Section -->
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Calendar Section -->
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
                // Redirect to the appointments page when an event is clicked
                window.location.href = './appointments.php';
            }
        });

        calendar.render();
    });
    </script>
</body>

</html>