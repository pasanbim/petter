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

      var $button = $(this);
      $button.find('.spinner-border').show();

  
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
          },
            complete: function() {
                $button.find('.spinner-border').hide();
            }

      });
  
    });
  
    if (window.location.pathname === '/password-reset.php') {
      const url = window.location.href;
      const urlObj = new URL(url);
      const token = urlObj.searchParams.get('token');
  
      if(token === null) {
          window.location.href = 'https://petter.pasanb.me/reset.php';
          return; // Stop further execution if redirected
      }
    }
  
  
      $('.pwreset').click(function() {
  
          $newpassword = $('.newpassword').val();
          $confirmpassword = $('.confirmpassword').val();
          const url = window.location.href;
          const urlObj = new URL(url);
          const token = urlObj.searchParams.get('token');
          
          var $button = $(this);
          $button.find('.spinner-border').show()
          
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
                              setTimeout(function() {
                                window.location.href = 'https://petter.pasanb.me/login.php';
                            }, 2000);
  
                          } else if (response.status == 2 || response.status == 3 || response.status == 4 || response.status == 5) {
                              erroralert(response.message);
  
                          } 
                      },
                        complete: function() {
                            $button.find('.spinner-border').hide();
                        }
                  
              });
  
          }
  
      });
  });
  