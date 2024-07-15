<?php 
include './includes/config.php';

$pet_id = $_GET['id'];

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT * FROM pets WHERE id = ?");
$stmt->bind_param("i", $pet_id);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();
$row = $result->fetch_assoc();


//redirect if no pet found
if (!$row) {
    header('Location: ./login.php');
    exit;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['name']); ?> | Petter</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/petprofile.css" />
    <style>
        .recordssection {
            text-align: left;
        }
        .recordssection .timeline-item {
            text-align: left;
        }
    </style>
    <?php include './includes/cdn_include.php'; ?>
</head>

<body>
    <header class="bg-light py- mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <img class="logo" src="./assets/images/logo.svg" alt="Logo">
            <a href="./login.php" class="header-button btn">Login</a>
        </div>
    </header>
    <main role="main" class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card card-fill timeline mb-4">
                        <div class="card-body text-center">
                            <div class="avatar avatar-xl mx-auto mb-4">
                                <img src="./uploads/<?php echo htmlspecialchars($row['petImage']); ?>" alt="Pet Image" class="avatar-img rounded-circle pet_image">
                            </div>
                            <h3 class="pet_name"><?php echo htmlspecialchars($row['name']); ?></h3>
                            <p class="small mb-3"><span class="badge badge-primary" style="padding:5px"><?php echo htmlspecialchars($row['breed']); ?></span></p>
                            <hr class="my-4">

                            <div class="pet-info d-flex justify-content-around mt-4">
                                <div class="info-item text-center">
                                    <i class="fas fa-paw fa-2x"></i>
                                    <p><b>Type:</b> <?php echo htmlspecialchars($row['type']); ?></p>
                                </div>
                                <div class="info-item text-center">
                                    <i class="fas fa-birthday-cake fa-2x"></i>
                                    <p><b>Birthday:</b> <?php echo htmlspecialchars($row['birthday']); ?></p>
                                </div>
                                <div class="info-item text-center">
                                    <i class="fas fa-paint-brush fa-2x"></i>
                                    <p><b>Color:</b> <?php echo htmlspecialchars($row['color']); ?></p>
                                </div>
                                <div class="info-item text-center">
                                    <i class="fas fa-weight-hanging fa-2x"></i>
                                    <p><b>Weight:</b> <?php echo htmlspecialchars($row['weight']); ?> Kg</p>
                                </div>
                                <div class="info-item text-center">
                                    <i class="fas fa-venus-mars fa-2x"></i>
                                    <p><b>Sex:</b> <?php echo htmlspecialchars($row['sex']); ?></p>
                                </div>
                                <div class="info-item text-center">
                                    <i class="fas fa-users fa-2x"></i>
                                    <p><b>Socialability:</b> <?php echo htmlspecialchars($row['socialability']); ?></p>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="card card-fill timeline" id="timeline">
                                <div class="card-body recordssection" id="recordssection">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include './includes/scripts_include.php'; ?>
    <script>
        function getFormattedDate(dateStr) {
            var date = new Date(dateStr);
            return date.toLocaleDateString('en-US');
        }

        function loadPetRecords(petid) {
            $.ajax({
                url: './process/records-process.php',
                type: 'POST',
                data: { petid: petid },
                success: function(response) {
                    var recordHtml = '';
                    var records = JSON.parse(response);

                    if (records.length === 0) {
                        recordHtml = `
                        <div class="d-flex align-items-center mb-1" style="justify-content: space-between; margin-top:0">
                            <p class="mb-0">No records found for this pet.</p>
                        </div>`;
                    } else {
                        records.forEach(function(record) {
                            recordHtml += `
                                <div class="pb-3 mt-2 timeline-item item-primary">
                                    <div class="pl-5 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="mb-1 recordtype"><strong>${record.type}</strong>`;
                                            
                            if (record.addedby === 'vet') {
                                recordHtml += ` &nbsp;<i class="fe fe-shield fe-12 mr-4" data-toggle="tooltip" data-placement="top" title="Verified by Vet" style="background-color: #FF7C00;color: white;padding: 4px; border-radius: 20%"></i>`;
                            }
                            
                            recordHtml += `</div>
                                            <div class="card d-inline-flex mb-3 mt-3">
                                                <div class="card-body bg-light py-2 px-3">${record.record}</div>
                                            </div>
                                            <br>
                                            <span class="badge badge-light p-2">Added on ${getFormattedDate(record.date)}</span>`;
                            
                            if (record.proof) {
                                recordHtml += `
                                            <span class="badge badge-light p-2">
                                                <a style="text-decoration: none" href="uploads/${record.proof}">
                                                    <span class="fe fe-file fe-11 text-muted"></span>
                                                </a>
                                            </span><br>`;
                            }
                            
                            recordHtml += `
                                        </div>
                                    </div>
                                </div>`;
                        });
                    }
                    $('.recordssection').html(recordHtml);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('.recordssection').html('<p>Error loading records. Please try again later.</p>');
                    console.error('AJAX Error:', textStatus, errorThrown);
                }
            });
        }

        $(document).ready(function() {
            var petId = <?php echo json_encode($pet_id); ?>;
            loadPetRecords(petId);
        });
    </script>
</body>

</html>
