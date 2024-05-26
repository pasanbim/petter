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
                        select.append('<option value="' + pet.name + '" petid="' + pet.id + '">' + pet.name + ' | ' + pet.id + '</option>');
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

                    var recordHtml = '';
                    var records = JSON.parse(petrecords);

                    if (records.length === 0) {
                        recordHtml = '<p class="mb-1">No records found for the selected pet.</p>';
                    } else {
                        records.forEach(function(record) {
                            recordHtml += `
                                <div class="pb-3 timeline-item item-primary">
                                    <div class="pl-5">
                                        <div class="mb-1 recordtype"><strong>${record.type} on</strong></div>
                                        <div class="card d-inline-flex mb-3 mt-3">
                                            <div class="card-body bg-light py-2 px-3">${record.record}</div>
                                        </div>
                                        <br>
                                        <span class="badge badge-light p-2">${record.date}</span>
                                    </div>
                                </div>
                            `;
                        });
                    }
                    $('.recordssection').html(recordHtml);
            } 
        });
    }

    // Event listener for the select pet dropdown change event
    $('.selectpet').change(function() {
        var selectedPetId = $(this).find('option:selected').attr('petid');
        loadPetRecordsOnSelect(selectedPetId);
    });



});
