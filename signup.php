<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | Petter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBv1WxQIx06rjpy0X4oZyqdOsDeW9mflvI&libraries=places&callback=addressAutocomplete"></script>

    </script>

    <link rel="stylesheet" href="./assets/css/signup-login.css">
    <link rel="stylesheet" href="./assets/css/global.css">
    <script src="./assets/js/global.js"></script>
    <script src="./assets/js/signup-login.js"></script>

</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-12 col-md-8 background-image d-none d-md-block"></div>
            <div class="col-12 col-md-4 d-flex align-items-center">
                <div class="signup-form">
                    <img src="./assets/images/logo.svg" alt="Petter Logo" width="150" class="mx-auto d-block mb-3">
                    <h3 class="text-center mb-4 title">Create an account</h3>
                    <div class="input-fields-wrapper">
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control address" id="autocomplete" placeholder="" autocomplete="off">
                            <input type="text" class="latitude" id="latitude" hidden readonly>
                            <input type="text" class="longitude" id="longitude" hidden readonly>
                        </div>
                        <div class="form-group password-field">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control password" name="password" autocomplete="off"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 signup mb-3">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                style="display: none;"></span>
                            <span class="button-text">Sign up</span>
                        </button>
                    </div>
                    <!-- <p class="text-center mt-4 signup-footer">
                        By clicking the "Sign up" button, you are creating a petter account and therefore you agree to
                        petter Company's Terms of Use and Privacy Policy.
                    </p> -->
                    <p class="text-center mt-2 alreadyhave">
                        Already have an account? <a style="text-decoration:none" href="./login.php"><span
                                class="alreadyhavespan">Log in</span></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>