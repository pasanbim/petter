<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Onboarding | Petter </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="./assests/css/onboarding.css">
</head>

<body>
    <div class="container mt-5">
        <div class="text-center mb-4">
            <img src="./assests/images/logo.svg" alt="" width="175">
        </div>
        <div class="steps-indicator d-flex justify-content-between align-items-center mb-5 form-container p-">
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
            <div class="step-container">
                <span class="step">4</span>
            </div>
        </div>
        <div class="form-container p-1">
            <h3 class="mb-2 text-center fw-bold">Let's onboard your pet</h3>
            <p class="subtext mb-5 text-center">Fill your pet's name and select the type</p>

            <form>
                <div class="mb-4">
                    <label for="fullName" class="form-label fw-bold">Pet's Name</label>
                    <input type="text" class="form-control " id="fullName" placeholder="Allen">
                </div>

                <div class="interests-container mt-4">
                <label for="Pettype" class="form-label fw-bold">Pet Type</label>
                    <div class="interest-cards">
                        <div class="card selected" id="dog">
                            <i class="fa-solid fa-dog fa-3x peticon selected"></i>
                        </div>
                        <div class="card " id="cat">
                            <i class="fa-solid fa-cat fa-3x peticon"></i>
                        </div>
                    </div>
                </div>



                <button type="submit" class="btn btn-primary w-100">Onboard Your Pet</button>
            </form>
        </div>
    </div>
</body>
<script>
document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('click', function() {

        document.querySelectorAll('.card').forEach(otherCard => {
            otherCard.classList.remove('selected');
            otherCard.querySelector('.fa-solid').classList.remove('selected');
        });

        this.classList.add('selected');
        this.querySelector('.fa-solid').classList.add('selected');
    });
});
</script>


</html>