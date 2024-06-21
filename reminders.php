<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reminders | Petter</title>
    <?php include './includes/cdn_include.php'; ?>

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
                        <div class="card card-fill timeline" id="timeline">
                            <div class="card-body recordssection" id="recordssection">

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

    <script>
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