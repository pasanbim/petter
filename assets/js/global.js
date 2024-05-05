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
