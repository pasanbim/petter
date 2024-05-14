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


function confirmdelete(callback) {
    iziToast.question({
        timeout: 10000,
        close: false,
        overlay: true,
        displayMode: 'once',
        backgroundColor: '#ffffff',
        icon : 'fa-solid fa-circle-question',
        iconColor: '#FF7C00',
        messageColor: 'black',
        progressBarColor: '#FF7C00',
        id: 'question',
        zindex: 999,
        title: 'Are you sure you want to delete this?',
        position: 'center',
        buttons: [
            ['<button style="background-color: #FF7C00; color:#ffffff; box-shadow:none; border: none;"><b>YES</b></button>', function (instance, toast) {
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                callback(); 
            }, true],
            ['<button>NO</button>', function (instance, toast) {
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            }],
        ],
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
