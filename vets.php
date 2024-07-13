<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Vets | Petter</title>
    <?php include './includes/cdn_include.php'; ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBv1WxQIx06rjpy0X4oZyqdOsDeW9mflvI"></script> <!-- Replace YOUR_API_KEY with your actual API key -->
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
                                <select id="type" class="form-control radius" id="radius">
                                    <option value="5">Within 05 km</option>
                                    <option value="10">Within 10 km</option>
                                    <option value="15">Within 15 km</option>
                                    <option value="20">Within 20 km</option>
                                    <option value="25">Within 20 km</option>
                                    <option value="50">Within 50 km</option>
                   
                                </select>
                            </div>
                        </div>
                        <div class="card card-fill timeline" id="timeline">
                            <div class="card-body" id="">
                            <div id="map" style="height: 500px;"></div> <!-- Map container -->
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
