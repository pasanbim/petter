<?php 

session_start();
$redirect = $_SERVER['REQUEST_URI'];
function sessionvalidation($redirect){
    if (!isset($_SESSION['email']) || !isset($_SESSION['name'])) {
        header("Location: ./login.php?redirect=$redirect");
    }
}
sessionvalidation($redirect);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Onboarding | Petter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    <link rel="stylesheet" href="./assets/css/onboarding.css">
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="icon" type="image/x-icon" href="assets/images/icon.png">
    <script src="./assets/js/global.js"></script>
    <script src="./assets/js/onboarding.js"></script>

</head>

<body>
    <div class="container-fluid mt-5">
        <div class="text-center mb-4">
        <img src="./assets/images/logo.svg" alt="Petter Logo" width="175">

        </div>
        <div class="steps-indicator d-flex justify-content-between align-items-center mb-5 form-container p-1">
            <div class="step-container">
                <span class="step active">1</span>
                <span class="line active"></span>
            </div>
            <div class="step-container">
                <span class="step">2</span>
                <span class="line"></span>
            </div>
            <div class="step-container">
                <span class="step">3</span>
                <span class="line"></span>
            </div>

        </div>

        <!-- Step 1: Select Pet Type -->
        <div id="step1" class="form-section active form-container p-0" data-step="1">
            <h3 class="mb-2 text-center fw-bold">Let's onboard your pet</h3>
            <p class="subtext mb-5 text-center">Fill your pet's name and select the type</p>
            <div class="mb-4">
                <label for="name" class="form-label fw-bold">Pet's Name</label>
                <input type="text" class="form-control" id="name" placeholder="Allen" required>
            </div>
            <div class="pettype-container mt-4">
                <label class="form-label fw-bold">Pet Type</label>
                <div class="pettype-cards">
                    <div class="card selected" id="dog">
                        <i class="fa-solid selected fa-dog fa-3x peticon"></i>
                    </div>
                    <div class="card" id="cat">
                        <i class="fa-solid fa-cat fa-3x peticon"></i>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary w-100 mt-4 next-step">Next Step</button>
        </div>

        <!-- Step 2: Enter Breed and Birthday -->
        <div id="step2" class="form-section form-container p-1" style="display: none;" data-step="2">
            <h3 class="mb-2 text-center fw-bold">Pet Details</h3>
            <p class="subtext mb-5 text-center">Please provide your pet's accurate information</p>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="breed" class="form-label fw-bold">Breed</label>
                    <input type="text" class="form-control" id="breed" placeholder="Labrador">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="birthyear" class="form-label fw-bold">Birth Year</label>
                    <input type="number" class="form-control" id="birthyear" placeholder="2021">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="color" class="form-label fw-bold">Color</label>
                    <input type="text" class="form-control" id="color" placeholder="Brown">
                </div>
                <div class="col-md-6 mb-4">
                <label for="weight" class="form-label fw-bold">Weight</label>
                    <input type="number" class="form-control" id="weight" placeholder="24 Kg">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="sex" class="form-label fw-bold">Sex</label>
                    <select class="form-select sex mb-3" id="sex">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="socialability" class="form-label fw-bold">Socialability</label>
                    <select class="form-select socialability" id="socialability">
                        <option value="Social">Social</option>
                        <option value="Tolerant">Tolerant</option>
                        <option value="Selective">Selective</option>
                        <option value="Aggressive">Aggressive</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary w-100 prev-step">
                        <i class="fa-solid fa-angle-left"></i> Back
                    </button>
                </div>
                <div class="col-md-9">
                    <button type="button" class="btn btn-primary w-100 next-step">Next Step</button>
                </div>
            </div>
        </div>

        <!-- Step 3: test -->
        <div id="step3" class="form-section form-container p-1" style="display: none;" data-step="3">
            <h3 class="mb-2 text-center fw-bold">Pet Details</h3>
            <p class="subtext mb-5 text-center">Please upload your pet's recent photograph</p>


            <div class="mb-4">
                <label for="dogAllergies" class="form-label fw-bold">Pet's Allergies</label>
                <select class="form-control" id="dogAllergies" multiple="multiple">
                    <option value="Grains">Grains</option>
                    <option value="Chicken">Chicken</option>
                    <option value="Beef">Beef</option>
                    <option value="Soy">Soy</option>
                    <option value="Dairy">Dairy</option>

                </select>
            </div>
            <div class="mb-4">
                <label for="petImage" class="form-label fw-bold">Pet Image</label>
                <input type="file" class="form-control" id="petImage" accept="image/*">
            </div>

            <div class="row">
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary w-100 prev-step">
                        <i class="fa-solid fa-angle-left"></i> Back
                    </button>
                </div>
                <div class="col-md-9">
                    <button type="button" class="btn btn-primary w-100" id="final-step">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            style="display: none;"></span>
                        <span class="button-text">Submit</span>
                    </button>

                </div>
            </div>
        </div>
    </div>
</body>

</html>