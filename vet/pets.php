<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Assigned Pets | Petter</title>
    <?php include './includes/cdn_include.php'; ?>
    <link rel="stylesheet" href="./assets/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="./assets/css/daterangepicker.css">
</head>

<body class="vertical light">
    <div class="wrapper">
        <?php include './includes/header.php'; include './includes/sidebar.php'; ?>
        <main role="main" class="main-content">
            <div class="container-fluid">



                <!-- request lap report modal -->

                <div class="modal fade" id="requestlabreport" tabindex="-1" role="dialog"
                    aria-labelledby="verticalModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title requestlabreporttitle" id="verticalModalTitle">Request Lap Report
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="labreporttype">Type</label>
                                        <select id="labreporttype" class="form-control">
                                            <option value="Blood Test">Blood Test</option>
                                            <option value="Urine Test">Urine Test</option>
                                            <option value="Biopsy">Biopsy</option>
                                            <option value="X-Ray">X-Ray</option>
                                            <option value="MRI">MRI</option>
                                            <option value="CT Scan">CT Scan</option>
                                            <option value="ECG">ECG</option>
                                            <option value="Allergy Test">Allergy Test</option>
                                            <option value="Genetic Test">Genetic Test</option>
                                            <option value="Microbiology Test">Microbiology Test</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary btn-reqlabreport" id="btn-reqlabreport"
                                        style="margin-left:5px">Request</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row align-items-center my-4">
                            <div class="col">
                                <h3 class="h3 page-title">Assigned Pets</h3>
                            </div>
                        </div>

                        <div class="row my-4">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <table class="table datatables table-bordered" id="petsTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Type</th>
                                                    <th>Breed</th>
                                                    <th>Weight</th>
                                                    <th>Birth Year</th>
                                                    <th>Sex</th>
                                                    <th>User</th>
                                                    <th width="25%">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
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
    $(document).ready(function() {
        $.ajax({
            url: './process/fetch_pets.php',
            method: 'GET',
            success: function(data) {
                console.log('Data fetched successfully:', data);
                if (data.message) {
                    console.log(data.message);
                } else {
                    var tableBody = $('#petsTable tbody');
                    data.forEach(function(pet) {

                    if(pet.sex == "male"){
                        pet.sex = "Male"
                    }
                    else{
                        pet.sex = "Female"
                    }
                    if(pet.type == "dog"){
                        pet.type = "Dog"
                    }
                    else{
                        pet.type = "Cat"
                    }
                        var row = '<tr>' +
                            '<td>' + pet.id + '</td>' +
                            '<td>' + pet.name + '</td>' +
                            '<td>' + pet.type + '</td>' +
                            '<td>' + pet.breed + '</td>' +
                            '<td>' + pet.weight + ' Kg</td>' +
                            '<td>' + pet.birthday + '</td>' +
                            '<td>' + pet.sex + '</td>' +
                            '<td>' + pet.user + '</td>' +
                            '<td>' +
                            '<a class="btn btn-success requestbutton" data-toggle="modal" data-target="#requestlabreport" data-petid="' +
                            pet.id +'" data-petowneremail="' + pet.user +'"><span class="fe fe-folder-plus fe-12 mr-2 mb-2" ></span>Request</a>' +
                            ' ' +
                            '<a href="../petprofile.php?id=' + pet.id +
                            '" class="btn btn-success view-pet" data-id="' + pet.id +
                            '"><span class="fe fe-external-link fe-12 mr-2 mb-2"></span>View</a>' +
                            ' ' +
                            '<a href="./add-record.php?id=' + pet.id +
                            '" class="btn btn-warning add-record" data-id="' + pet.id +
                            '"><span class="fe fe-plus fe-12 mr-2 mb-2"></span>Add</a>' +
                            '</td>' +
                            '</tr>';
                        tableBody.append(row);
                    });

                    // Initialize DataTable after data is populated
                    $('#petsTable').DataTable({
                        autoWidth: true,
                        language: {
                            emptyTable: "No pets found.",
                            info: "Showing _START_ to _END_ of _TOTAL_ pets",
                            infoEmpty: "Showing 0 to 0 of 0 pets",
                            infoFiltered: "(filtered from _MAX_ total pets)"
                        },
                        lengthMenu: [
                            [10, 25, 50, 100],
                            [10, 25, 50, 100]
                        ],
                        pagingType: "simple_numbers",
                        pageLength: 10,
                        dom: 'rt'
                    });

                    // Add event listeners for the action buttons
                    $('.view-pet').on('click', function() {
                        var petId = $(this).data('id');
                        // Redirect or perform the action for viewing the pet
                        window.location.href = '../petprofile.php?id=' + petId;
                    });

                    $('.add-record').on('click', function() {
                        var petId = $(this).data('id');
                        // Redirect or perform the action for adding a record
                        window.location.href = './add_record.php?pet_id=' + petId;
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });

        $('#petsTable tbody').on('click', '.requestbutton', function() {
            var petId = $(this).data('petid');
            var owneremail = $(this).data('petowneremail');
            $('#btn-reqlabreport').data('petid', petId);
            $('#btn-reqlabreport').data('owneremail', owneremail);
        });


        $('#btn-reqlabreport').on('click', function() {
            var petId = $(this).data('petid');
            var owneremail = $(this).data('owneremail');
            var labreporttype = $('#labreporttype').val();

            $.ajax({
            url: '../process/labreport-process.php',
            method: 'POST',
            data: {
                petid: petId,
                owneremail: owneremail,
                labreporttype: labreporttype
            },
            success: function(response) {

                $('#requestlabreport').modal('hide');
               if(response.status == 1) {
                   successalert(response.message);
               }
               else {
                   erroralert(response.message);
               }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
            
            
        });
    });
    </script>

    <?php include './includes/scripts_include.php'; ?>
</body>

</html>