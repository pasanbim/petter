<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard | Petter</title>
    <?php include './includes/cdn_include.php'; ?>

  </head>
  <body class="vertical light">
  <div class="wrapper">
    <?php  
    include './includes/header.php'; 
    include './includes/sidebar.php';
    ?> 

    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row align-items-center mb-2">
                        <div class="col">
                            <h3 class="h3 page-title">Hello <?php echo $_SESSION['name'];?>,</h3>
                        </div>

                        
                    </div>
                    <div class="mb-2 align-items-center">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                
                            </div>
                        </div> 
                    </div>
                </div> 
            </div> 
        </div>
    </main>
</div>

<?php include './includes/scripts_include.php'; ?>

  </body>
</html>