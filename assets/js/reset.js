$(document).ready(function() {
  // Reset all form elements
  $('.reset').click(function() {

    var email = $('.email').val();

    if (email === '') {
        erroralert("Please enter you email");
        return;
    }
    else if (validateemail(email) == false) {
        erroralert("Invalid Email");
        return
        
    }

    // send ajax request to the server

    $.ajax({
        url: './process/reset-process.php',
        type: 'POST',
        data: {
            email: email
        },
        success: function(response) {
            if (response.status == 0) {
                erroralert("Email not found");

            } else if (response.status == 1) {
                successalert("Reset link sent to your email");

            } else if (response.status == 2) {
                erroralert("Error sending email");

            } else if (response.status == 3) {
                erroralert("Error sending email");

            } else if (response.status == 4) {
                erroralert("Error sending email");

            } else if (response.status == 5) {
                erroralert("Error sending email");

            } else if (response.status == 6) {
                erroralert("Error sending email");

            } else {
                erroralert("Error sending email");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", error);
        }
    });



  });
});