$(document).ready(function() {

    function loadPetsInsideSelect() {
        $.ajax({
            url: 'process/pets-process.php',
            type: 'GET',
            success: function(response) {
                    var pets = JSON.parse(response);
                    var select = $('.selectpet');
                    select.empty();
                    pets.forEach(function(pet) {
                        select.append('<option value="' + pet.name + '" petid="' + pet.id + '">' + pet.id + '</option>');
                    });

                    if (pets.length > 0) {
                        select.val(pets[0].name).change();  // Automatically select the first pet
                    }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX request failed:", textStatus, errorThrown);
            }
        });
    }

    loadPetsInsideSelect();

    function loadPetRecordsOnSelect(petid) {
        $.ajax({
            url: 'process/records-process.php',
            type: 'POST',
            data: { petid: petid },
            success: function(petrecords) {
                console.log(petrecords);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX request failed:", textStatus, errorThrown);
            }
        });
    }


    $('.selectpet').change(function() {
        var selectedPetId = $(this).find('option:selected').attr('petid');
        loadPetRecordsOnSelect(selectedPetId);
    });
});
