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


    $(document).ready(function() {
        $('#dogAllergies').select2({
            placeholder: "Select or type allergies",
            allowClear: true,
            width: '100%',
            tags: true, 
            tokenSeparators: [',', ' '], 
            createTag: function (params) {

                if (params.term.trim() === '') {
                    return null; 
                }
    
                var term = params.term.trim().toLowerCase();
                var options = $('#dogAllergies option').map(function() {
                    return this.value.toLowerCase();
                }).get();
    
                if (options.indexOf(term) > -1) {
                    return null; 
                }
    
                return {
                    id: term,
                    text: term,
                    newTag: true 
                };
            }
        });
    });
    


    // Final step AJAX submission
    $('#final-step').click(function() {
        if (validateStep(3)) {  // Assuming step 3 is the last step and has been validated
            var formData = new FormData();
            formData.append('name', $('#name').val());
            formData.append('type', $('.pettype-cards .selected').attr('id'));
            formData.append('breed', $('#breed').val());
            formData.append('color', $('#color').val());
            formData.append('weight', $('#weight').val());
            formData.append('birthday', $('#birthday').val());
            formData.append('sex', $('#sex').val());
            formData.append('socialability', $('#socialability').val());
            formData.append('petImage', $('#petImage')[0].files[0]);        
            
            $('#dogAllergies').find(':selected').each(function() {
                formData.append('allergies[]', $(this).val()); // Use array notation for multiple values
            });


    
            // Show spinner and update button text
            $(this).find('.spinner-border').show();
            $(this).find('.button-text').text('Processing...');
    
            $.ajax({
                type: "POST",
                url: "./process/onboarding-save.php",  // Ensure this is the correct path to your server-side script
                data: formData,
                contentType: false,  // Must be false to correctly send FormData
                processData: false,  // Must be false to prevent jQuery from converting the FormData into a string
                success: function(response) {
                    $('#final-step').find('.spinner-border').hide();
                    $('#final-step').find('.button-text').text('Submit');
                    alert(response);  // Optionally replace with a more user-friendly success message or action
                    $('.container').html('<p class="text-success">Thank you for registering your pet!</p>');
                },
                error: function(xhr, status, error) {
                    $('#final-step').find('.spinner-border').hide();
                    $('#final-step').find('.button-text').text('Submit');
                    alert('Error: ' + error);  // Optionally replace with a more user-friendly error handling approach
                }
            });
        } else {
        }
    });
    });

    
    
function validateStep(stepNumber) {
    if (stepNumber === 1) {
        var fullName = $('#name').val();
        var petTypeSelected = $('.pettype-cards .selected').length > 0;
        if (!fullName.trim() || !petTypeSelected) {
            alert("Please enter the pet's name and select a pet type");
            return false;
        }
    } else if (stepNumber === 2) {
        var breed = $('#breed').val();
        var birthday = $('#birthyear').val();
        var color = $('#color').val();
        var weight = $('#weight').val();
        if (!breed.trim() || !birthday || !color.trim() || !weight.trim()){
            alert("Please fill all the fields in this step");
            return false;
        }
    } else if (stepNumber === 3) {

    
        if ($('#petImage').length > 0 && $('#petImage')[0].files.length > 0) {
            var petImage = $('#petImage')[0].files[0];
        } else {
            alert("Please insert an image of your pet");
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
