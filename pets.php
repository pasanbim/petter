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
    <div class="card-body">
                    
    <div class="modal fade" id="verticalModal" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
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
              <div class="btn copy-share-link fe fe-copy fe-12 mb-2 ml-2" style="color: white; background-color:#FF7C00;"></div>
              <div class="btn share-link-fb fa-brands fa-facebook-f fe-12 mb-2 ml-2" style="color: white; background-color:#0866FF;"></div>
              <div class="btn share-link-wa fa-brands fa-whatsapp fe-12 mb-2 ml-2" style="color: white; background-color:#07C141;"></div>
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
          <div class="row" id="pets-list">
          </div>
        </div>
      </div>
    </div>
  </main>

<?php include './includes/scripts_include.php'; ?>
</body>

</html>
