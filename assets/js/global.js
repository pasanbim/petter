function erroralert(message) {
    iziToast.show({
        message: message,
        position: 'topRight',
        backgroundColor: '#ffffff',
        icon : 'fa-solid fa-circle-xmark',
        iconColor: '#FF7C00',
        messageColor: 'black',
        animateInside: false,
        progressBarColor: '#FF7C00',
        

    });
}
function successalert(message) {
    iziToast.show({
        message: message,
        position: 'topRight',
        backgroundColor: '#ffffff',
        icon : 'fa-solid fa-circle-check',
        iconColor: '#FF7C00',
        messageColor: 'black',
        animateInside: false,
        progressBarColor: '#FF7C00',
        

    });
}

 function validateemail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test($email);
 }

 function validatetext($text) {
    var textReg = /^[A-Za-z\s]+$/;
    return textReg.test($text);
  }
  
//  function validateaddress($address) {
//     var addressReg = /^[A-Za-z0-9\s]+$/;
//     return addressReg.test($address);
//   }
  
 
 function validatepassword($password) {
    if ($password.length < 5) {
        return false;
        
    }
    return true;
 }
