function addressAutocomplete() {

    const options = {
        types: ['geocode'],
        componentRestrictions: { country: 'LK' }
    };
    
    const autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('autocomplete'), options);


    autocomplete.addListener('place_changed', function() {
        const place = autocomplete.getPlace();

        if (!place.geometry) {
            console.log("Returned place contains no geometry");
            return;
        }

        const latitude = place.geometry.location.lat();
        const longitude = place.geometry.location.lng();

        document.getElementById('latitude').value = latitude;
        document.getElementById('longitude').value = longitude;
    });
}


$(document).ready(function() {
    $('.signup').click(function() {
        var $button = $(this);  // Reference to the button clicked
        var name = $('.name').val();
        var email = $('.email').val();
        var address = $('.address').val();
        var latitude = $('.latitude').val();
        var longitude = $('.longitude').val();
        var password = $('.password').val();
        var otp = $('.otp').val();

        if (name === '' || email === '' || address === '' || password === '' || (otp === '' && $('.otp').length > 0)) {
            erroralert("Please fill all fields");
            return;
        } 
        else if (validatetext(name) == false) {
            erroralert("Name should contain only letters");
            return;
        } 
        else if (latitude === '' || longitude === '') {
            erroralert("Please select your address from the dropdown");
            return;
        }
        else if (validateemail(email) == false) {
            erroralert("Invalid Email");
            return;
        }
         else if (validatepassword(password) == false) {
            erroralert("Password should be at least 5 characters long");
            return;
        }

        // Prepare form data for AJAX
        var formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('address', address);
        formData.append('latitude', latitude);
        formData.append('longitude', longitude);
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
                
                if (response.status == 11) {
                    successalert("Signup Successful");
                    window.location = './dashboard.php'; 

                } 
                else if (response.status == 0) {
                    erroralert("Invalid OTP or email mismatch");
                } 
                else if (response.status == 8) {
                    erroralert("User Already Exists");
                } 
                else if (response.status == 9) {
                    erroralert("Please select a valid address");
                } 
                else if (response.status == 2) {
                    erroralert("Something went wrong");
                } 
                else {

                    if (!$('.otp').length) {
                        var otpField = '<div class="form-group"><label for="otp" class="form-label mt-2">OTP</label><input type="number" class="form-control otp" name="otp" required></div>';
                        $('.password-field').append(otpField);
                        $('.email').prop('disabled', true);

                        if (response.status == 6) {
                            successalert("5 Digit OTP Sent to your email");
                        }
                    } 
                    else if (response.status == 7) {
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


$(document).ready(function() {
    $('.login').click(function() {
        
        var $button = $(this);  // Reference to the button clicked
        var email = $('.email').val();
        var password = $('.password').val();

        if (email === '' || password === '') {
            erroralert("Please fill all fields");
            return;
        }
         else if (validateemail(email) == false) {
            erroralert("Invalid Email");
            return
        } 


        // Prepare form data for AJAX
        var formData = new FormData();
        formData.append('email', email);
        formData.append('password', password);
        
        $button.find('.spinner-border').show();
        $button.find('.button-text').text('Processing...');

        // AJAX request to the server
        $.ajax({
            url: './process/login-process.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $button.find('.spinner-border').hide();
                $button.find('.button-text').text('Login');
                
                if (response.status == 0) {
                    erroralert("Invalid Credentials");

                } 
                else if (response.status == 1) {
                    successalert("Login Successful");
                    let urlParams = new URLSearchParams(window.location.search);
                    let redirectUrl = urlParams.get('redirect');

                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    }
                    else {
                        window.location.href = './dashboard.php';
                    }

                } 
                else if (response.status == 11) {
                    successalert("Login Successful");
                    let urlParams = new URLSearchParams(window.location.search);
                    let redirectUrl = urlParams.get('redirect');

                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    }
                    else {
                        window.location.href = './vet/dashboard.php';
                    }

                } 
                else if (response.status == 111) {
                    successalert("Login Successful");
                    let urlParams = new URLSearchParams(window.location.search);
                    let redirectUrl = urlParams.get('redirect');

                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    }
                    else {
                        window.location.href = './admin/dashboard.php';
                    }

                } 
                 else if (response.status == 2) {
                    erroralert("User Not Found");
                }
                 else if (response.status == 3) {
                    erroralert("Your Accout is Deactivated");
                }

                 else if (response.status == 4) {
                    erroralert("Invalid Email");
                }

            },
            error: function(xhr, status, error) {
                $button.find('.spinner-border').hide();
                $button.find('.button-text').text('Login');
                console.error("AJAX error:", error);
            }
        });
    });
});
