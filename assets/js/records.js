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
                    select.append('<option value="' + pet.name + '" petid="' + pet.id + '" petname="' + pet.name + '">' + pet.name + ' | ' + pet.id + '</option>');
                });

                if (pets.length > 0) {
                    select.val(pets[0].name).change();  // Automatically select the first pet
                }

            },

        });
    }

    function loadPetRecordsOnSelect(petid, petname) {
        $.ajax({
            url: 'process/records-process.php',
            type: 'POST',
            data: { petid: petid },
            success: function(petrecords) {
                var recordHtml = '';
                var records = JSON.parse(petrecords);



                $('.btn-addrecord').attr('data-petid', petid);
                $('.addrecordmodaltitle').html('Add Record For ' + petname);



                if (records.length === 0) {
                    recordHtml = `
                    <div class="d-flex align-items-center mb-1" style="justify-content: space-between; margin-top:0">
                        <p class="mb-0">No records found for the selected pet.</p>
                        <button data-toggle="modal" data-target="#addrecordmodal" class="btn btn-primary ml-3" style="margin-top:0 !important">
                            <span class="fe fe-plus fe-12 mr-2 mb-2"></span>New Record
                        </button>
                    </div>`;
                    
                } else {
                    records.forEach(function(record) {
                        recordHtml += `
                            <div class="pb-3 timeline-item item-primary">
                                <div class="pl-5">
                                    <div class="mb-1 recordtype"><strong>${record.type}</strong></div>
                                    <div class="card d-inline-flex mb-3 mt-3">
                                        <div class="card-body bg-light py-2 px-3">${record.record}</div>
                                    </div>
                                    <br>
                                    <span class="badge badge-light p-2">Added on ${getFormattedDate(record.date)}</span>`;

                        if (record.proof) {
                            recordHtml += `
                            <span class="badge badge-light p-2">
                            <a style="text-decoration: none" href="uploads/${record.proof}"> <span class="fe fe-file fe-11 text-muted"></span></a>
                            </span><br>`;
                        }

                        recordHtml += `
                                </div>
                            </div>`;
                    });
                }
                $('.recordssection').html(recordHtml);
            }
        });
    }

    // Event listener for the select pet dropdown change event
    $('.selectpet').change(function() {
        var selectedPetId = $(this).find('option:selected').attr('petid');
        var selectedPetName = $(this).find('option:selected').attr('petname');
        loadPetRecordsOnSelect(selectedPetId, selectedPetName);
    });

    function getFormattedDate(date) {
        const today = new Date();
        const recordDate = new Date(date);
        const diffInDays = Math.floor((today - recordDate) / (1000 * 60 * 60 * 24));
        if (diffInDays === 0) {
            return "Today";
        } else if (diffInDays === 1) {
            return "Yesterday";
        } else {
            return `${diffInDays} days ago`;
        }
    }

    // Load the pets into the select element when the page is ready
    loadPetsInsideSelect();

});
