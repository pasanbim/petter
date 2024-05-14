<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard | Petter</title>
    <?php include './includes/cdn_include.php'; ?>
</head>

<body class="vertical light">
<?php include './includes/header.php'; include './includes/sidebar.php'; ?>
  <main role="main" class="main-content">
    <div class="container-fluid">
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
          <div class="row" id="pets-list">
          </div>
        </div>
      </div>
    </div>
  </main>

<?php include './includes/scripts_include.php'; ?>
</body>

</html>
