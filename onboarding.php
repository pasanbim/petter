<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Onboarding | Petter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="./assets/css/onboarding.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/onboarding.js"></script>

</head>
<body>
    <div class="container mt-5">
        <div class="text-center mb-4">
            <img src="./assets/images/logo.svg" alt="Petter Logo" width="175">
        </div>
        <div class="steps-indicator d-flex justify-content-between align-items-center mb-5 form-container p-1">
            <div class="step-container">
                <span class="step active"  onclick="showStep(1)">1</span>
                <span class="line active"></span>
            </div>
            <div class="step-container">
                <span class="step"  onclick="showStep(2)">2</span>
                <span class="line"></span>
            </div>
            <div class="step-container">
                <span class="step"  onclick="showStep(3)">3</span>
                <span class="line"></span>
            </div>
            <div class="step-container">
                <span class="step">4</span>
            </div>
        </div>

        <!-- Step 1: Select Pet Type -->
        <div id="step1" class="form-section active form-container p-0" data-step="1">
            <h3 class="mb-2 text-center fw-bold">Let's onboard your pet</h3>
            <p class="subtext mb-5 text-center">Fill your pet's name and select the type</p>
            <div class="mb-4">
                <label for="fullName" class="form-label fw-bold">Pet's Name</label>
                <input type="text" class="form-control" id="fullName" placeholder="Allen" required>
            </div>
            <div class="interests-container mt-4">
                <label class="form-label fw-bold">Pet Type</label>
                <div class="interest-cards">
                    <div class="card" id="dog">
                        <i class="fa-solid fa-dog fa-3x peticon"></i>
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
            <p class="subtext mb-5 text-center">Please provide your pet's breed and birthday</p>
            <div class="mb-4">
                <label for="breed" class="form-label fw-bold">Breed</label>
                <input type="text" class="form-control" id="breed" placeholder="Enter your pet's breed">
            </div>
            <div class="mb-4">
                <label for="birthday" class="form-label fw-bold">Birthday</label>
                <input type="date" class="form-control" id="birthday">
            </div>
            <button type="button" class="btn btn-primary w-100 prev-step">Previous Step</button>
        </div>
    </div>


</body>
</html>
