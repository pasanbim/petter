<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reminders | Petter</title>
    <link href="https://releases.transloadit.com/uppy/v2.0.1/uppy.min.css" rel="stylesheet">
    <script src="https://releases.transloadit.com/uppy/v2.0.1/uppy.min.js"></script>
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
                                <h3 class="h3 page-title">Reminders</h3>
                            </div>
                            <div class="col-auto">
                                <button data-toggle="modal" data-target="#addrecordmodal" class="btn btn-primary"
                                    style="margin-top:0 !important; padding: 7px !important">
                                    <span class="fe fe-plus fe-12 mr-2 mb-2"></span>New Record
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
    </script>
    <?php include './includes/scripts_include.php'; ?>

</body>

</html>