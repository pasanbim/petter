<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard | Petter</title>
    <?php include './includes/cdn_include.php'; ?>


<<<<<<< HEAD

</head>

<body class="vertical  light  ">
    <div class="card-body">
        <p class="mb-2"><strong>Date &amp; Time Pickers</strong></p>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="date-input1">Date Picker</label>
                <div class="input-group">
                    <input type="text" class="form-control drgpicker" id="date-input1" value="04/24/2020"
                        aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="time-input2">Time Picker</label>
                <div class="input-group">
                    <input type="text" class="form-control time-input" id="time-input2" placeholder=""
                        aria-describedby="button-addon2">
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src='assets/js/daterangepicker.js'></script>
    <script>
    $('.drgpicker').daterangepicker({
        singleDatePicker: true,
        timePicker: false,
        showDropdowns: true,
        locale: {
            format: 'MM/DD/YYYY'
        }
    });
    </script>
    <?php include './includes/scripts_include.php'; ?>


</body>

</html>
=======
date_default_timezone_set('Asia/Colombo');
echo date('Y-m-d h:i A', time());
echo "test.php file is created by me";
?>
>>>>>>> 2e57f5c0215fcfb273f18bc2a33fc70392684407
