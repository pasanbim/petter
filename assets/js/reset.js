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
                erroralert(response.message);

            } else if (response.status == 1) {
                successalert(response.message);

            } else if (response.status == 2) {
                erroralert(response.message);

            } 
             else if (response.status == 3) {
                erroralert(response.message);

            } 
        }
    });



  });


    $('pwreset').click(function() {

        $newpassword = $('.newpassword').val();
        $confirmpassword = $('.confirmpassword').val();
        const url = 'https://petter.pasanb.me/passwordreset.php?token=10570b2ad8a3e59aea17';
        const urlObj = new URL(url);
        const token = urlObj.searchParams.get('token');

        if($newpassword === '') {
            erroralert("Please enter your new password");
            return;
        }

        else if($confirmpassword === '') {
            erroralert("Please confirm your password");
            return;
        }

        else if(validatepassword($newpassword) == false) {
            erroralert("Password must be at least 5 characters");
            return;
        }
        else if($newpassword !== $confirmpassword) {
            erroralert("Passwords do not match");
            return;
        }

        else if($newpassword == $confirmpassword) {

            $.ajax({
                url: './process/reset-process.php',
                type: 'POST',
                data: {
                    
                    token: token,
                    newpassword: $newpassword,
                    confirmpassword: $confirmpassword,
                    action: 'resetpassword'
                },
                success: function(response) {
                        if (response.status == 1) {
                            successalert(response.message);

                        } else if (response.status == 2 || response.status == 3 || response.status == 4 || response.status == 5) {
                            erroralert(response.message);

                        } 
                    } 
                
            });

        }

    });
});
