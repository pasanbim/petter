$(document).ready(function() {

    function loadPetsInsideSelectForReminders() {
    $.ajax({
        url: 'process/pets-process.php',
        type: 'GET',
        success: function(response) {
            var pets = JSON.parse(response);
            var select = $('.selectpetforreminders');
            select.empty();
            pets.forEach(function(pet) {
                select.append('<option value="' + pet.name + '" petid="' + pet.id + '" petname="' + pet.name + '">' + pet.name + ' | ' + pet.id + '</option>');
            });

            if (pets.length > 0) {
                select.val(pets[0].name).change();  // Automatically select the first pet
            }

        },

    });
    }

    loadPetsInsideSelectForReminders();

    $('.selectpetforreminders').on('change', function() {
    $('.btn-addreminder').attr('data-petid', random());

    });

});




