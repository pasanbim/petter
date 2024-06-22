<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reminders | Petter</title>
    <?php include './includes/cdn_include.php'; ?>
    <link rel="stylesheet" href="./assets/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="./assets/css/daterangepicker.css">
</head>

<body class="vertical light">
    <div class="wrapper">

        <?php include './includes/header.php'; include './includes/sidebar.php'; ?>
        <main role="main" class="main-content">
            <div class="container-fluid">


                <!-- Add new reminder modal -->
                <div class="modal fade" id="addremindermodal" tabindex="-1" role="dialog"
                    aria-labelledby="verticalModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title addremindermodaltitle" id="verticalModalTitle"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-inline" style="display: flex;align-items: center;">
                                    <div class="form-row">

                                        <div class="form-group col-md-12">
                                            <label for="type">Type</label>
                                            <select id="type" class="form-control">
                                                <option value="vaccination">Vaccination</option>
                                                <option value="surgery">Surgery</option>
                                                <option value="allergy">Allergy</option>
                                                <option value="medication">Medication</option>
                                                <option value="checkup">Checkup</option>
                                                <option value="labresult">Lab Result</option>
                                                <option value="nutrition">Nutrition</option>
                                                <option value="behavior">Behavior</option>
                                                <option value="breeding">Breeding</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="date">Date</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control drgpicker" id="date">
                                                <div class="input-group-append">
                                                    <div class="input-group-text" id="button-addon-date">
                                                        <span class="fe fe-calendar fe-16 "></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="time">Time</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control time-input" id="time">
                                                <div class="input-group-append">
                                                    <div class="input-group-text" id="button-addon-time">
                                                        <span class="fe fe-clock fe-16 "></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="record">Reminder</label>
                                            <input type="text" class="form-control" id="record">
                                        </div>

                                        <button class="btn btn-primary btn-addreminder" id="btn-addreminder"
                                            style="margin-left:5px">
                                            Add Reminder
                                            <span id="spinner" class="spinner-border spinner-border-sm" role="status"
                                                style="display: none; margin-left: 5px;"></span>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row align-items-center my-4">
                            <div class="col">
                                <h3 class="h3 page-title">Reminders</h3>
                            </div>
                            <div class="col-auto">
                                <select id="type" class="form-control selectpetforreminders">
                                </select>
                            </div>
                            <div class="col-auto">
                                <button data-toggle="modal" data-target="#addremindermodal" class="btn btn-primary"
                                    style="margin-top:0 !important; padding: 7px !important">
                                    <span class="fe fe-bell fe-12 mr-2 mb-2"></span>New Reminder
                                </button>
                            </div>
                        </div>

                        <div class="row my-4 noremindermessage" style="display:none;">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body remindersbody">

                                        <div class="d-flex align-items-center mb-1"
                                            style="justify-content: space-between; margin-top:0">
                                            <p class="mb-0">No reminders found for the selected pet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row my-4 reminderbodywithdatatable" style="display:none;">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body remindersbody">
                                        <table class="table datatables table-bordered" id="dataTable-1">
                                            <thead>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Reminder</th>
                                                    <th>Remind Prior to</th>
                                                    <th>Status</th>
                                                    <th style = "text-align:center">Action</th>
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

    <script>
        var table = $('#dataTable-1').DataTable({
        autoWidth: true,
        language: {
            emptyTable: "No reminders found for the selected pet.",
            info: "Showing _START_ to _END_ of _TOTAL_ reminders",
            infoEmpty: "Showing 0 to 0 of 0 Reminders",
            infoFiltered: "(filtered from _MAX_ total reminders)",
        },
        "lengthMenu": [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        "pagingType": "simple_numbers", // Use simple pagination
        "pageLength": 100, // Set initial page length
        // "dom": 'rt<"bottom"ip><"clear">',
        "dom": 'rt'
    });


    $('.drgpicker').daterangepicker({
        singleDatePicker: true,
        timePicker: false,
        showDropdowns: true,
        maxDate: moment(),
        locale: {
            format: 'MM/DD/YYYY'
        }
    });

    $('.time-input').timepicker({
        scrollDefault: 'now',
        zindex: '9999',
        interval: 15,
        defaultTime: '11.30PM',

    });
    </script>
    <?php include './includes/scripts_include.php'; ?>

</body>

</html>