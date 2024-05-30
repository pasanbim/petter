<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Pets | Petter</title>
    <link href="https://releases.transloadit.com/uppy/v2.0.1/uppy.min.css" rel="stylesheet">
    <script src="https://releases.transloadit.com/uppy/v2.0.1/uppy.min.js"></script>


    <?php include './includes/cdn_include.php'; ?>

</head>

<body class="vertical light">
    <div class="wrapper">

        <?php include './includes/header.php'; include './includes/sidebar.php'; ?>
        <main role="main" class="main-content">
            <div class="container-fluid">

                <!-- Add Record Modal-->

                <div class="modal fade" id="addrecordmodal" tabindex="-1" role="dialog"
                    aria-labelledby="verticalModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title addrecordmodaltitle" id="verticalModalTitle"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>
                            <div class="modal-body">
                                <div class="card-inline" style="display: flex;align-items: center;">
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
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

                                        <div class="form-group col-md-12">
                                            <label for="record">Record</label>
                                            <input type="text" class="form-control" id="record">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="proof" class="form-label">Proof</label>
                                            <input class="form-control proof" style="height: unset" type="file"
                                                id="proof" accept=".jpg, .png, .heic, .jpeg, .pdf">
                                        </div>

                                        <button class="btn btn-primary btn-addrecord" id="btn-addrecord"
                                            style="margin-left:5px">
                                            Add Record
                                            <span id="spinner" class="spinner-border spinner-border-sm" role="status"
                                                style="display: none; margin-left: 5px;"></span>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>






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
                                                <option value="medication">Medication</option>
                                                <option value="surgery">Surgery</option>
                                                <option value="appointment">Vet Appointment</option>
                                                <option value="checkup">Health Checkup</option>
                                                <option value="training">Training</option>
                                                <option value="feeding">Feeding</option>
                                                <option value="bathing">Bathing</option>
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



                <!-- Share Pet Modal-->

                <div class="modal fade" id="sharepetmodal" tabindex="-1" role="dialog"
                    aria-labelledby="verticalModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="verticalModalTitle">Share Profile</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-inline" style="display: flex;align-items: center;">
                                    <div class="card d-inline-flex mb-2">
                                        <div class="card-body sharelink bg-light py-2 px-3" id="sharelink">
                                        </div>
                                    </div>
                                    <div class="btn copy-share-link fe fe-copy fe-12 mb-2 ml-2"
                                        style="color: white; background-color:#FF7C00;"></div>
                                    <div class="btn share-link-fb fa-brands fa-facebook-f fe-12 mb-2 ml-2"
                                        style="color: white; background-color:#0866FF;"></div>
                                    <div class="btn share-link-wa fa-brands fa-whatsapp fe-12 mb-2 ml-2"
                                        style="color: white; background-color:#07C141;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row align-items-center my-4">
                            <div class="col">
                                <h3 class="h3 page-title">My Pets</h3>
                            </div>
                            <div class="col-auto">
                                <a href="./onboarding.php" class="btn btn-primary">
                                    <span class="fe fe-plus fe-12 mr-2"></span>New Pet
                                </a>
                            </div>
                        </div>
                        <div class="row" id="pets-list"></div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src='assets/js/jquery.timepicker.js'></script>
    <script src='assets/js/daterangepicker.js'></script>
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