$(document).ready(function() {
    // Handle clicking on pet type cards
    $('.card').click(function() {
        $('.card').removeClass('selected').find('.fa-solid').removeClass('selected');
        $(this).addClass('selected').find('.fa-solid').addClass('selected');
    });

    // Handle clicking on the next step button
    $('.next-step').click(function() {
        let currentStep = parseInt($('.form-section.active').data('step'));
        if (validateStep(currentStep)) {
            showStep(currentStep + 1);
        }
    });

    // Handle clicking on the previous step button
    $('.prev-step').click(function() {
        let currentStep = parseInt($('.form-section.active').data('step'));
        showStep(currentStep - 1);
    });

    // Handle clicking on step indicators
    $('.step').click(function() {
        let stepIndex = parseInt($(this).text().trim());
        let currentStep = parseInt($('.form-section.active').data('step'));

        if (stepIndex > currentStep) {
            if (validateStep(currentStep)) {
                showStep(stepIndex);
            }
        } else {
            showStep(stepIndex);
        }
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
});