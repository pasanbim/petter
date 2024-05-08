$(document).ready(function() {
    $('.signup').click(function() {
        var $button = $(this);  // Reference to the button clicked
        var name = $('.name').val();
        var email = $('.email').val();
        var password = $('.password').val();
        var otp = $('.otp').val();

        if (name === '' || email === '' || password === '' || (otp === '' && $('.otp').length > 0)) {
            erroralert("Please fill all fields");
            return;
        } else if (validatetext(name) == false) {
            erroralert("Name should contain only letters");
            return;
        } else if (validateemail(email) == false) {
            erroralert("Invalid Email");
            return;
        } else if (validatepassword(password) == false) {
            erroralert("Password should be at least 5 characters long");
            return;
        }

        // Prepare form data for AJAX
        var formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('password', password);
        if ($('.otp').length && otp !== '') {
            formData.append('otp', otp);
        }
        
        $button.find('.spinner-border').show();
        $button.find('.button-text').text('Processing...');

        // AJAX request to the server
        $.ajax({
            url: './process/signup-process.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $button.find('.spinner-border').hide();
                $button.find('.button-text').text('Sign up');
                
                if (response.status == 1) {
                    successalert("Signup Successful");
                } else if (response.status == 0) {
                    erroralert("Invalid OTP");
                } else if (response.status == 2) {
                    erroralert("Something went wrong");
                } else {
                    if (!$('.otp').length) {
                        var otpField = '<div class="form-group"><label for="otp" class="form-label mt-2">OTP</label><input type="number" class="form-control otp" name="otp" required></div>';
                        $('.password-field').append(otpField);
                        $('.email').prop('disabled', true);
                        if (response.message == "sent") {
                            successalert("5 Digit OTP Sent to your email");
                        }
                    } else {
                        erroralert("Invalid OTP, Please try again");
                    }
                }
            },
            error: function(xhr, status, error) {
                $button.find('.spinner-border').hide();
                $button.find('.button-text').text('Sign up');
                console.error("AJAX error:", error);
            }
        });
    });
});
