$(document).ready(function() {
    $('.signup').click(function() {
        
        if (validateemail($('.email').val())==false) {
            erroralert("Invalid Email");
            return;
        }

        var name = $('.name').val();
        var email = $('.email').val();
        var password = $('.password').val();
        var otp = $('.otp').val();

        // Check if all fields are filled
        if (name === '' || email === '' || password === '' || (otp === '' && $('.otp').length)) {
            erroralert("Please fill all fields");
            return; // Stop further execution
        }

        // Prepare form data for AJAX
        var formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('password', password);

        if ($('.otp').length && otp !== '') {
            formData.append('otp', otp);
        }

        // AJAX request to the server
        $.ajax({
            url: './process/signup-process.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {

                if (response.status==1) {
    
                    successalert("Signup Successfull");
                }
                else if (response.status==0) {
                    erroralert("Invalid OTP");
                }
                else if (response.status==2) {
                    erroralert("Something went wrong");
                }
                
                else {
                    if (!$('.otp').length) {

                        var otpField = '<div class="form-group"><label for="otp" class="form-label mt-2">OTP</label><input type="number" class="form-control otp" name="otp" required></div>';
                        $('.password-field').append(otpField);
                        $('.email').prop('disabled', true);

                        
                        if (response.status=="sent") {
                            successalert("5 Digit OTP Sent to your email");
                        }

                        
                    } else {
                        erroralert("Invalid OTP, Please try again");
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error:", error);
            }
        });
    });
});
