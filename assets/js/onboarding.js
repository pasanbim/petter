$(document).ready(function() {
    // Handle clicking on pet type cards
    $('.card').click(function() {
        $('.card').removeClass('selected').find('.fa-solid').removeClass('selected');
        $(this).addClass('selected').find('.fa-solid').addClass('selected');
    });

    // Handle clicking on the next step button
    $('.next-step').click(function() {
        let currentStep = $('.form-section.active').data('step');
        if (validateStep(currentStep)) {
            showStep(currentStep + 1);
        }
    });

    // Handle clicking on the previous step button
    $('.prev-step').click(function() {
        let currentStep = $('.form-section.active').data('step');
        showStep(currentStep - 1);
    });

    // Handle clicking on step indicators
    $('.step').click(function() {
        let stepIndex = parseInt($(this).text().trim());
        let currentStep = $('.form-section.active').data('step');
        
        if (stepIndex > currentStep) {
            if (validateStep(currentStep)) {
                showStep(stepIndex);
            }
        } else {
            showStep(stepIndex);
        }
    });

    // Final step AJAX submission
    $('#final-step').click(function() {
        if (validateStep(3)) { // Assuming this is the last step
            var data = {
                fullName: $('#fullName').val(),
                petType: $('.interest-cards .selected').attr('id'),
                breed: $('#breed').val(),
                birthday: $('#birthday').val(),
                sex: $('.sex').val()
            };
    
            // Show spinner and update button text
            $(this).find('.spinner-border').show();
            $(this).find('.button-text').text('Processing...');
    
            $.ajax({
                type: "POST",
                url: "./process/onboarding-save.php",
                data: data,
                success: function(response) {
                    $('#final-step').find('.spinner-border').hide();
                    $('#final-step').find('.button-text').text('Submit');
                    alert(response);
                    $('.container').html('<p class="text-success">Thank you for registering your pet!</p>');
                },
                error: function(xhr, status, error) {
                    $('#final-step').find('.spinner-border').hide();
                    $('#final-step').find('.button-text').text('Submit');
                    alert('Error: ' + error);
                }
            });
        } else {
        }
    });
});

function validateStep(stepNumber) {
    if (stepNumber === 1) {
        var fullName = $('#fullName').val();
        var petTypeSelected = $('.interest-cards .selected').length > 0;
        if (!fullName.trim() || !petTypeSelected) {
            alert("Please enter the pet's name and select a pet type");
            return false;
        }
    } else if (stepNumber === 2) {
        var breed = $('#breed').val();
        var birthday = $('#birthday').val();
        if (!breed.trim() || !birthday) {
            alert("Please enter both the breed and the birthday of your pet");
            return false;
        }
    } else if (stepNumber === 3) {
        var test = $('#test').val();  // Assuming you meant to validate sex here as it's a part of step 3
        if (!test) {
            alert("Please enter value for test field");
            return false;
        }
    }
    return true;
}


function showStep(stepNumber) {
    $('.form-section').hide().removeClass('active');  // Hide all sections and remove 'active' class
    $('#step' + stepNumber).show().addClass('active'); // Show and mark current section as active

    // Update step indicators
    $('.step-container').each(function(index) {
        var step = $(this).find('.step');
        var line = $(this).find('.line');
        step.removeClass('active'); // Remove active from all steps first
        line.removeClass('active'); // Remove active from all lines first

        if (index + 1 < stepNumber) {
            line.addClass('active');
        }
        if (index + 1 == stepNumber) {
            step.addClass('active');
        }
    });
}

// Initialize the form by showing the first step
showStep(1);
