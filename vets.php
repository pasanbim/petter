<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Vets | Petter</title>
    <?php include './includes/cdn_include.php'; ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script> <!-- Replace YOUR_API_KEY with your actual API key -->
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
                                <h3 class="h3 page-title">Vets</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="radius">Select Radius:</label>
                            <select class="form-control radius" id="radius">
                                <option value="10">10 km</option>
                                <option value="20">20 km</option>
                                <option value="50">50 km</option>
                                <option value="100">100 km</option>
                            </select>
                        </div>
                        <div class="card card-fill timeline" id="timeline">
                            <div class="card-body">
                                <div id="map" style="height: 500px;"></div> <!-- Map container -->
                                <div id="no-records" class="d-flex align-items-center mb-1" style="justify-content: space-between; margin-top:0; display: none;">
                                    <p class="mb-0">No records found for the selected pet.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php include './includes/scripts_include.php'; ?>
    <script src="./assets/js/vets.js"></script>
</body>
</html>
