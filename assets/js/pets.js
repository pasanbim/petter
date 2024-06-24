$(document).ready(function() {

    function loadPets() {
        $.ajax({
            url: 'process/pets-process.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status == 3) {
                    erroralert(response.message);
                    window.location.href = 'onboarding.php';
                    return;
                }
                var petsHtml = '';
                response.forEach(function(pet) {
                    petsHtml += `
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <div class="card-body text-center">
                                    <div class="row align-items-center justify-content-end">
                                        <div class="col-auto">
                                            <div class="file-action">
                                                <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted sr-only">Action</span>
                                                </button>
                                                <div class="dropdown-menu m-2">
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fe fe-meh fe-12 mr-4"></i>Profile
                                                    </a>
                                                    <a class="dropdown-item" href="" data-petid="${pet.id}" data-petname="${pet.name}" class="addrecord btn mb-2 btn-outline-success" id="addrecord" data-toggle="modal" data-target="#addrecordmodal">
                                                        <i class="fe fe-plus-square fe-12 mr-4"></i>Add Record
                                                    </a>
                                                    <a class="dropdown-item" href="" data-petid="${pet.id}" data-petname="${pet.name}" class="addreminder btn mb-2 btn-outline-success" id="addreminder" data-toggle="modal" data-target="#addremindermodal">
                                                        <i class="fe fe-bell fe-12 mr-4"></i>Setup Reminder
                                                    </a>
                                                    <a class="dropdown-item" href="./editpet.php?id=${pet.id}">
                                                        <i class="fe fe-edit fe-12 mr-4"></i>Edit
                                                    </a>
                                                    <a class="dropdown-item" href="" data-shareid="${pet.id}" class="sharepet btn mb-2 btn-outline-success" id="sharepet" data-toggle="modal" data-target="#sharepetmodal">
                                                        <i class="fe fe-share-2 fe-12 mr-4"></i>Share
                                                    </a>
                                                    <a class="dropdown-item delete" data-deleteid="${pet.id}" href="">
                                                        <i class="fe fe-delete fe-12 mr-4"></i>Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="avatar avatar-lg mt-4">
                                        <a href="">
                                            <img src="./uploads/${pet.petImage}" alt="..." class="avatar-img rounded-circle">
                                        </a>
                                    </div>
                                    <div class="card-text my-2">
                                        <h4 class="card-title petname mt-3 my-0">${pet.name}</h4>
                                        <p class="small text-muted mb-0">${pet.sex} ${pet.socialability} ${pet.type} Born in ${pet.birthday}</p>
                                        <p class="small">
                                            <span class="badge badge-primary" style="font-size:90%;">${pet.id}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                $('#pets-list').html(petsHtml);
            }
        });
    }

    function loadPetRecordsOnSelect(petid) {
        $.ajax({
            url: 'process/records-process.php',
            type: 'POST',
            data: { petid: petid },
            success: function(petrecords) {
                var recordHtml = '';
                var records = JSON.parse(petrecords);

                if (records.length === 0) {
                    recordHtml = `
                    <div class="d-flex align-items-center mb-1" style="justify-content: space-between; margin-top:0">
                        <p class="mb-0">No records found for the selected pet.</p>
                    </div>`;                } else {
                        records.forEach(function(record) {
                            recordHtml += `
                                <div class="pb-3 mt-2 timeline-item item-primary">
                                    <div class="pl-5 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="mb-1 recordtype"><strong>${record.type}</strong>`;
                                            
                            if (record.addedby === 'vet') {
                                recordHtml += ` &nbsp;<i class=" fe fe-shield fe-12 mr-4" data-toggle="tooltip" data-placement="top" title="Verified by Vet" style = "background-color: #FF7C00;color: white;padding: 4px; border-radius: 20%"></i>`;
                            }
                            
                            recordHtml += `</div>
                                            <div class="card d-inline-flex mb-3 mt-3">
                                                <div class="card-body bg-light py-2 px-3">${record.record}</div>
                                            </div>
                                            <br>
                                            <span class="badge badge-light p-2">Added on ${getFormattedDate(record.date)}</span>`;
                            
                            if (record.proof) {
                                recordHtml += `
                                            <span class="badge badge-light p-2">
                                                <a style="text-decoration: none" href="uploads/${record.proof}">
                                                    <span class="fe fe-file fe-11 text-muted"></span>
                                                </a>
                                            </span><br>`;
                            }
                            
                            recordHtml += `
                                        </div>`;
                            
                            if (record.addedby === 'vet') {
                                recordHtml += `
                                        <div class="dropdown" style="text-align:center">
                                            <button class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                            <div class="dropdown-menu dropdown-menu-center" aria-labelledby="dr1">
                                                <a class="dropdown-item" href="#" class="addrecord btn mb-2 btn-outline-success" id="addrecord" data-toggle="modal" data-target="#addrecordmodal">
                                                    <i class="fe fe-user fe-12 mr-4"></i>Contact Vet
                                                </a>
                                            </div>
                                        </div>`;
                            } else {
                                recordHtml += `
                                         <div class="dropdown" style="text-align:center">
                                            <button class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                            <div class="dropdown-menu dropdown-menu-center" aria-labelledby="dr1">
                                        
                                                <a class="dropdown-item deleterecord" data-recordid="${record.id}" class="deleterecord btn mb-2 btn-outline-success" id="deleterecord">
                                                    <i class="fe fe-delete fe-12 mr-4"></i>Delete
                                                </a>
                                            </div>
                                        </div>`;
                            }
                            
                            recordHtml += `
                                    </div>
                                </div>`;
                        });
                }
                $('.recordssection').html(recordHtml);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('.recordssection').html('<p>Error loading records. Please try again later.</p>');
                console.error('AJAX Error:', textStatus, errorThrown);
            }
        });
    }

    // Event listener for the select pet dropdown change event
    $('.selectpet').change(function() {
        var selectedPetId = $(this).find('option:selected').attr('petid');
        loadPetRecordsOnSelect(selectedPetId);
    });

    function getFormattedDate(date) {
        const today = new Date();
        const recordDate = new Date(date);
        const diffInDays = Math.floor((today - recordDate) / (1000 * 60 * 60 * 24));
        if (diffInDays === 0) {
            return "Today";
        } else if (diffInDays === 1) {
            return "Today";
        } else {
            return `${diffInDays} days ago`;
        }
    }

    // Load the pets into the select element when the page is ready
    loadPets();

    // Load share link in modal
    $(document).on('click', '#sharepet', function(e) {
        var shareid = $(this).data('shareid');
        sharelink = window.location.origin + '/profile.php?petid=' + shareid;
        $('#sharelink').html(sharelink);
    });

    // Change add record modal title for each pet
    $(document).on('click', '#addrecord', function(e) {
        var petName = $(this).data('petname');
        var petId = $(this).data('petid');

        $('#btn-addrecord').attr('data-petid', petId);
        $('.addrecordmodaltitle').html('Add Record For ' + petName);
    });

    // Change add reminder modal title for each pet
    $(document).on('click', '#addreminder', function(e) {
        var petName = $(this).data('petname');
        var petId = $(this).data('petid');

        $('#btn-addreminder').attr('data-petid', petId);
        $('.addremindermodaltitle').html('Setup Reminder For ' + petName);
    });

    // Copy share link to clipboard
    $(document).on('click', '.copy-share-link', function(e) {
        var sharelink = $('#sharelink').html();
        navigator.clipboard.writeText(sharelink).then(function() {
            successalert('Link copied to clipboard');
        });
    });

    // Share link on Facebook
    $('.share-link-fb').click(function(e) {
        var sharelink = $('#sharelink').html();
        window.open('https://www.facebook.com/share.php?u=' + sharelink, '_blank');
    });

    // Share link on WhatsApp
    $('.share-link-wa').click(function(e) {
        var sharelink = $('#sharelink').html();
        window.open('https://api.whatsapp.com/send?text=' + sharelink, '_blank');
    });

    // Share link on Twitter
    $('.share-link-tw').click(function(e) {
        var sharelink = $('#sharelink').html();
        window.open('https://twitter.com/share?url=' + sharelink, '_blank');
    });

    // Delete pet
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        var deleteid = $(this).data('deleteid');

        confirmdelete(function() {
            $.ajax({
                url: "./process/pets-process.php",
                type: "POST",
                data: { deleteid: deleteid },
                dataType: 'json',
                success: function(response) {
                    if (response.status == 0 || response.status == 1 || response.status == 2) {
                        successalert(response.message);
                        if (response.status == 1) {
                            loadPets(); // Refresh pets list without reloading the page
                        } else if (response.status == 2) {
                            erroralert(response.message);
                        }
                    }
                }
            });
        });
    });



  // Edit pet
    $(document).on('click', '.editpet', function(e) {
    e.preventDefault();
    var formData = new FormData();
    formData.append('petid', $('#petid').val());
    formData.append('name', $('#name').val());
    formData.append('type', $('#type').find(":selected").text());
    formData.append('breed', $('#breed').val());
    formData.append('color', $('#color').val());
    formData.append('weight', $('#weight').val());
    formData.append('birthday', $('#birthday').val());
    formData.append('sex', $('#sex').find(":selected").text());
    formData.append('socialability', $('#socialability').find(":selected").text());
    formData.append('petImage', $('#customFile')[0].files[0]);
    formData.append('existingpetimage', $('#existingpetimage').val());
    formData.append('action', 'editpet');

    $('#spinner').show();

    $.ajax({
        url: "./process/pets-process.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {

            $('#spinner').hide();

            if (response.status == 0 || response.status == 2 || response.status == 3 || response.status == 4) {
                erroralert(response.message);
            }
            else if(response.status ==1){
                successalert(response.message);
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
        }
    });
});


    // Add record
    $(document).on('click', '.btn-addrecord', function(e) {
        e.preventDefault();
        var id = $(this).data('petid');
        var recordtype = $('#type').find(":selected").text();
        var date = $('#date').val();
        var record = $('#record').val();
        var proof = $('#proof')[0].files[0];
    
        if (recordtype == '' || date == '' || record == '') {
            erroralert('All fields are required');
            return;
        }
    
        var formData = new FormData();
        formData.append('petid', id);
        formData.append('recordtype', recordtype);
        formData.append('date', date);
        formData.append('record', record);
        formData.append('proof', proof);

        $('#spinner').show();
        $(this).prop('disabled', true);

        $.ajax({
            url: "./process/pets-process.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                $('#spinner').hide();
                $('#btn-addrecord').prop('disabled', false);

                if (response.status == 5) {
                    erroralert(response.message);
                } else if (response.status == 6) {
                    erroralert(response.message);
                } else if (response.status == 7) {
                    successalert(response.message);

                    // Clear input fields
                    $('#record').val('');
                    $('#proof').val('');
                    $('#addrecordmodal').modal('hide');

                    // Refresh the records section
                    loadPetRecordsOnSelect(id);
                } else if (response.status == 8) {
                    erroralert(response.message);
                }
            }
        });

        $(this).removeData('petid'); // clear pet id from button
    });
});


//this code wont update the records section when a new record is added from the record.php, when there is not record

// $(document).ready(function() {
//     function loadPets() {
//         $.ajax({
//             url: 'process/pets-process.php',
//             type: 'GET',
//             dataType: 'json',
//             success: function(response) {
//                 if (response.status == 3) {
//                     erroralert(response.message);
//                     window.location.href = 'onboarding.php';
//                     return;
//                 }
//                 var petsHtml = '';
//                 response.forEach(function(pet) {
//                     petsHtml += `
//                         <div class="col-md-4">
//                             <div class="card shadow mb-4">
//                                 <div class="card-body text-center">
//                                     <div class="row align-items-center justify-content-end">
//                                         <div class="col-auto">
//                                             <div class="file-action">
//                                                 <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
//                                                     <span class="text-muted sr-only">Action</span>
//                                                 </button>
//                                                 <div class="dropdown-menu m-2">
//                                                     <a class="dropdown-item" href="#">
//                                                         <i class="fe fe-meh fe-12 mr-4"></i>Profile
//                                                     </a>
//                                                     <a class="dropdown-item" href="" data-petid="${pet.id}" data-petname="${pet.name}" class="addrecord btn mb-2 btn-outline-success" id="addrecord" data-toggle="modal" data-target="#addrecordmodal">
//                                                         <i class="fe fe-plus-square fe-12 mr-4"></i>Add Record
//                                                     </a>
//                                                     <a class="dropdown-item" href="#">
//                                                         <i class="fe fe-bell fe-12 mr-4"></i>Setup Alert
//                                                     </a>
//                                                     <a class="dropdown-item" href="#">
//                                                         <i class="fe fe-edit fe-12 mr-4"></i>Edit
//                                                     </a>
//                                                     <a class="dropdown-item" href="" data-shareid="${pet.id}" class="sharepet btn mb-2 btn-outline-success" id="sharepet" data-toggle="modal" data-target="#sharepetmodal">
//                                                         <i class="fe fe-share-2 fe-12 mr-4"></i>Share
//                                                     </a>
//                                                     <a class="dropdown-item delete" data-deleteid="${pet.id}" href="">
//                                                         <i class="fe fe-delete fe-12 mr-4"></i>Delete
//                                                     </a>
//                                                 </div>
//                                             </div>
//                                         </div>
//                                     </div>
//                                     <div class="avatar avatar-lg mt-4">
//                                         <a href="">
//                                             <img src="./uploads/${pet.petImage}" alt="..." class="avatar-img rounded-circle">
//                                         </a>
//                                     </div>
//                                     <div class="card-text my-2">
//                                         <h4 class="card-title petname mt-3 my-0">${pet.name}</h4>
//                                         <p class="small text-muted mb-0">${pet.sex} ${pet.socialability} ${pet.type} Born in ${pet.birthday}</p>
//                                         <p class="small">
//                                             <span class="badge badge-primary" style="font-size:90%;">${pet.id}</span>
//                                         </p>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//                     `;
//                 });
//                 $('#pets-list').html(petsHtml);
//             }
//         });
//     }

//     // Load pets on page load
//     loadPets(); 


//     //load share link in modal
//     $(document).on('click', '#sharepet', function(e) {

//         var shareid = $(this).data('shareid');
//         sharelink = window.location.origin + '/profile.php?petid=' + shareid;
//         $('#sharelink').html(sharelink);

    
        
//     });

//     //change add record modal title for each pet

//     $(document).on('click', '#addrecord', function(e) {
//         var petName =  $(this).data('petname');
//         var petId = $(this).data('petid');

//         $('#btn-addrecord').attr('data-petid', petId);
//         $('.addrecordmodaltitle').html('Add Record For ' + petName);
    
        
//     });

//     //copy share link to clipboard
//     $(document).on('click', '.copy-share-link', function(e) {

//         var sharelink = $('#sharelink').html();
//         navigator.clipboard.writeText(sharelink).then(function() {
//             successalert('Link copied to clipboard');
//         });    
//     });

//     //share link on facebook

//     $('.share-link-fb').click(function(e) {
//         var sharelink = $('#sharelink').html();
//         window.open('https://www.facebook.com/share.php?u=' + sharelink, '_blank');
        
//     });

//     //share link on whatsapp

//     $('.share-link-wa').click(function(e) {
//         var sharelink = $('#sharelink').html();
//         window.open('https://api.whatsapp.com/send?text=' + sharelink, '_blank');
        
//     });

//     //share link on twitter

//     $('.share-link-tw').click(function(e) {
//         var sharelink = $('#sharelink').html();
//         window.open('https://twitter.com/share?url=' + sharelink, '_blank');
        
//     });

    

//     // Delete pet

//     $(document).on('click', '.delete', function(e) {
//         e.preventDefault();
//         var deleteid = $(this).data('deleteid');

//         confirmdelete(function() {
//             $.ajax({
//                 url: "./process/pets-process.php",
//                 type: "POST",
//                 data: { deleteid: deleteid },
//                 dataType: 'json',
//                 success: function(response) {
//                     if (response.status == 0 || response.status == 1 || response.status == 2) {
//                         successalert(response.message);
//                         if (response.status == 1) {
//                             loadPets(); // Refresh pets list without reloading the page
//                         }
//                         else if (response.status == 2) {
//                             erroralert(response.message);
//                         }
//                     }
//                 }
//             });
//         });
//     });


//     // Add record
//     $(document).on('click', '.btn-addrecord', function(e) {
//         e.preventDefault();
//         var id = $(this).data('petid');
//         var recordtype = $('#type').find(":selected").text();
//         var date = $('#date').val();
//         var record = $('#record').val();
//         var proof = $('#proof')[0].files[0];
    
//         if (recordtype == '' || date == '' || record == '') {
//             erroralert('All fields are required');
//             return;
//         }
    
//         var formData = new FormData();
//         formData.append('petid', id);
//         formData.append('recordtype', recordtype);
//         formData.append('date', date);
//         formData.append('record', record);
//         formData.append('proof', proof);

//         $('#spinner').show();
//         $(this).prop('disabled', true);

        
    
//         $.ajax({
//             url: "./process/pets-process.php",
//             type: "POST",
//             data: formData,
//             contentType: false,
//             processData: false,
//             dataType: 'json',
//             success: function(response) {

//                 $('#spinner').hide();
//                 $('#btn-addrecord').prop('disabled', false);
                
//                 if (response.status == 5) {
//                     erroralert(response.message);
//                 }
//                 else if (response.status == 6) {
//                     erroralert(response.message);
//                 }
//                 else if (response.status == 7) {
//                     successalert(response.message);

//                     // Clear input fields

//                     $('#record').val('');
//                     $('#proof').val('');
//                     $('#addrecordmodal').modal('hide');


//                 }
//                 else if (response.status == 8) {
//                     erroralert(response.message);
//                 }
//             }
//         });
    
//         $(this).removeData('petid'); // clear pet id from button
//     });
    

  
// });
