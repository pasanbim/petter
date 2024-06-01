<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forogt Password | Petter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    <link rel="stylesheet" href="./assets/css/signup-login.css">
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="icon" type="image/x-icon" href="assets/images/icon.png">
    <script src="./assets/js/global.js"></script>
    <script src="./assets/js/reset.js"></script>

</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-12 col-md-8 background-image d-none d-md-block"></div>
            <div class="col-12 col-md-4 d-flex align-items-center">
                <div class="login-form">
                    <img src="./assets/images/logo.svg" alt="Petter Logo" width="150" class="mx-auto d-block mb-3 mt-2">
                    <h3 class="text-center mb-4 title" style="margin-bottom:40px !important">Reset Your Password</h3>
                    <div class="input-fields-wrapper">
                        <div class="form-group">
                            <label for="newpassword" class="form-label">New Password</label>
                            <input type="password" class="form-control newpassword" name="newpassword" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control confirmpassword" name="confirmpassword" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 pwreset mb-3">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            <span class="button-text">Reset</span>
                        </button>


                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>