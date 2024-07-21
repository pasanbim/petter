<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Vets | Petter</title>
    <?php include './includes/cdn_include.php'; ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBv1WxQIx06rjpy0X4oZyqdOsDeW9mflvI"></script>

    <style>
        #map {
            display: none;
        }
        #no-vets {
            display: none;
        }
    </style>
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
                                <h3 class="h3 page-title">Vets Nearby</h3>
                            </div>
                            <div class="col-auto">
                                <select class="form-control radius" id="radius">
                                    <option value="5">Within 05 km</option>
                                    <option value="10">Within 10 km</option>
                                    <option value="15">Within 15 km</option>
                                    <option value="20">Within 20 km</option>
                                    <option value="25">Within 25 km</option>
                                    <option value="50">Within 50 km</option>
                                    <option value="150">Within 150 km</option>
                                    <option value="300">Within 300 km</option>
                                </select>
                            </div>
                        </div>
                        <div class="card card-fill timeline" id="timeline">
                            <div class="card-body">
                                <div id="map" style="height: 500px;"></div> <!-- Map container -->
                                <div class="d-flex align-items-center mb-1" style="justify-content: space-between; margin-top:0;">
                                    <p class="mb-0" id="no-vets">No Vets found for the selected radius.</p>
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
