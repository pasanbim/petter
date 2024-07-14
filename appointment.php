<?php 
ob_start();
include './includes/config.php'; // Ensure you include your configuration file for database connection

if (!isset($_GET['vetId']) || empty($_GET['vetId'])) {
    header('Location: vets.php');
    exit;
}

$vetId = $_GET['vetId'];
$sqltogetvetinfo = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sqltogetvetinfo);
$stmt->bind_param("i", $vetId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $vetinfo = $result->fetch_assoc();
    $vetname = $vetinfo['name']; 
} else {
    header('Location: vets.php');
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Make an Appointment | Petter</title>
    <?php include './includes/cdn_include.php'; ?>
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
                                <h3 class="h3 page-title">Make an Appointment</h3>
                            </div>
                        </div>
                        <div class="card card-fill timeline" id="timeline">
                            <div class="card-body">
                                <div class="card my-4">
                                    <div class="card-body">
                                        <form id="example-form" action="#">
                                            <div>
                                                <h3>Doctor</h3>
                                                <section>
                                                    <div class="row mt-5 align-items-center">
                                                        <div class="col-md-3 text-center mb-5">
                                                            <div class="avatar avatar-xl">
                                                                <?php 
                                                                if ($vetinfo['image'] != '') {
                                                                    echo '<img src="./assets/avatars/' . htmlspecialchars($vetinfo['image']) . '" alt="..." class="avatar-img rounded-circle">';
                                                                } else {
                                                                    echo '<img src="./assets/images/doctor.jpg" alt="..." class="avatar-img rounded-circle" style="width:150px">';
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row align-items-center">
                                                                <div class="col-md-7 mb-4">
                                                                    <h3 class="mb-1">
                                                                        <?php echo "Dr. " . htmlspecialchars($vetinfo['name']); ?>
                                                                    </h3>
                                                                    <p class="mb-1">
                                                                        <?php echo htmlspecialchars($vetinfo['address']); ?>
                                                                    </p>
                                                                    <input type="hidden"
                                                                        value="<?php echo htmlspecialchars($vetId); ?>"
                                                                        name="vetid" id="vetid"
                                                                        data-vetname="<?php echo $vetinfo['name']?>">
                                                                    <p class="small mb-3">
                                                                        <span class="badge badge-primary"
                                                                            style="padding:5px"><?php echo htmlspecialchars($vetinfo['license']); ?></span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <h3>Pet & Mode</h3>
                                                <section>
                                                    <?php 
                                                    $sqltogetallthepets = "SELECT * FROM pets WHERE `user` = ?";
                                                    $stmt = $conn->prepare($sqltogetallthepets);
                                                    $stmt->bind_param("s", $_SESSION['email']);
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();

                                                    if ($result === false) {
                                                        die("Error retrieving pet info: " . $conn->error);
                                                    }
                                                    if ($result->num_rows > 0) {
                                                        echo '<select class="form-control" id="pet" name="pet" required>';
                                                        echo '<option value="" disabled selected>Please select your pet</option>';

                                                        while ($row = $result->fetch_assoc()) {
                                                            echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['name']) . '</option>';
                                                        }
                                                        echo '</select>';
                                                    } else {
                                                        echo '<p>No pets found. Please add a pet first.</p>';
                                                    }
                                                    ?> <br>
                                                    <select class="form-control" id="appoinmenttype" name="appoinmenttype" required>
                                                        <option value="" disabled selected>Please select appointment type</option>
                                                        <option value="online">Online</option>
                                                        <option value="visitvet">Visit Vet</option>
                                                    </select>
                                                </section>
                                                <h3>Date & Time</h3>
                                                <section>
                                                    <div class="form-group">
                                                        <label for="appointment_date">Select Date</label>
                                                        <input type="date" class="form-control" id="appointment_date"
                                                            name="appointment_date" required onfocus="this.showPicker()"
                                                            min="<?php echo date('Y-m-d'); ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="appointment_time">Select Time</label>
                                                        <input type="time" class="form-control" id="appointment_time"
                                                            name="appointment_time" required
                                                            onfocus="this.showPicker()">
                                                    </div>
                                                </section>
                                                <h3>Confirmation</h3>
                                                <section>
                                                    <h4>Appointment Details</h4><br>
                                                    <div class="confirmation-details">
                                                        <p><strong>Doctor:</strong> <span id="confirm-doctor"></span>
                                                        </p>
                                                        <p><strong>Pet:</strong> <span id="confirm-pet"></span></p>
                                                        <p><strong>Date:</strong> <span id="confirm-date"></span></p>
                                                        <p><strong>Time:</strong> <span id="confirm-time"></span></p>
                                                        <p><strong>Type:</strong> <span id="confirm-appointment-type"></span></p>
                                                    </div>
                                                    <button type="button" id="finalize-appointment"
                                                        class="btn btn-primary">Book the Appointment</button>

                                                </section>
                                            </div>
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

    <script>
    $(document).ready(function() {

        // Update doctor confirmation when the doctor is selected/loaded
        $('#confirm-doctor').text("Dr. " + $('#vetid').data('vetname'));

        // Update pet confirmation when pet selection changes
        $('#pet').on('change', function() {
            var selectedPetName = $(this).find('option:selected').text();
            $('#confirm-pet').text(selectedPetName);
        });
        $('#appoinmenttype').on('change', function() {
            var selectedtype = $(this).find('option:selected').text();
            $('#confirm-appointment-type').text(selectedtype);
        });

        // Update date and time confirmation when inputs change
        $('#appointment_date').on('change', function() {
            $('#confirm-date').text($(this).val());
        });

        $('#appointment_time').on('change', function() {
            //time in 12 hour format
            var time = $(this).val();
            var hours = Number(time.match(/^(\d+)/)[1]);
            var minutes = Number(time.match(/:(\d+)/)[1]);
            var AMPM = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + AMPM;
            $('#confirm-time').text(strTime);
        });

        $('#finalize-appointment').on('click', function() {
    var vetId = $('#vetid').val();
    var petId = $('#pet').val();
    var appointmentType = $('#appoinmenttype').val();
    var appointmentDate = $('#appointment_date').val();
    var appointmentTime = $('#appointment_time').val();

    // Convert 24-hour time to 12-hour format
    var time = appointmentTime;
    var hours = Number(time.match(/^(\d+)/)[1]);
    var minutes = Number(time.match(/:(\d+)/)[1]);
    var AMPM = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var formattedTime = hours + ':' + minutes + ' ' + AMPM;

    $.ajax({
        type: 'POST',
        url: './process/appointment-process.php',
        data: {
            vetid: vetId,
            pet: petId,
            appointment_date: appointmentDate,
            appointment_time: formattedTime, // Send the formatted 12-hour time
            appointment_type: appointmentType
        },
        success: function(response) {
            if (response.status == 1) {
                successalert(response.message);
                setTimeout(function() {
                    window.location.href = './appointments.php';
                }, 2000);
            } else if (response.status == 0) {
                erroralert(response.message);
            }
        },
        error: function() {
            alert('Error booking the appointment.');
        }
    });
});

    });
    </script>

    <?php include './includes/scripts_include.php'; ?>
</body>

</html>