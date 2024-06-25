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
            }
        });
    }

    function loadpetreminders($petid) {
        $.ajax({
            url: 'process/reminders-process.php',
            type: 'POST',
            data: {
                petid: $petid,
                action: 'getallreminders'
            },
            success: function(response) {
                var reminders = JSON.parse(response);
                var rows = [];
    
                if (reminders.length === 0) {
                    $('.noremindermessage').show();
                    $('.reminderbodywithdatatable').hide();
                } else {
                    $('.noremindermessage').hide();
                    $('.reminderbodywithdatatable').show();
    
                    reminders.forEach(function(reminder, index) {
                        var badgeClass = reminder.status.toLowerCase() === 'sent' ? 'badge-success' : 'badge-primary';
    
                        var row = [
                            reminder.type,
                            reminder.date,
                            reminder.time,
                            reminder.reminder,
                            reminder.remind_prior_to + ' hour(s)',
                            `<td><span class="badge badge-pill p-1 px-2 ${badgeClass}" style="color:white">${reminder.status.charAt(0).toUpperCase() + reminder.status.slice(1)}</span></td>`
                        ];
                        
                        var dropdown = `
                        <td>
                          <div class="dropdown" style="text-align:center">
                            <button class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" type="button" id="dr${index}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu dropdown-menu-center" aria-labelledby="dr${index}">
                            ${reminder.status.toLowerCase() === 'active' ?`

                              <a class="dropdown-item editreminder" data-reminderid="${reminder.id}" class="btn mb-2 btn-outline-success">
                               <i class="fe fe-edit fe-12 mr-4"></i>Edit
                              </a>

                              <a class="dropdown-item deletereminder" data-reminderid="${reminder.id}" class="btn mb-2 btn-outline-success">
                               <i class="fe fe-delete fe-12 mr-4"></i>Delete
                              </a>` : ''}
                              
                              ${reminder.status.toLowerCase() === 'sent' ? `
                              <a class="dropdown-item deletereminder" data-reminderid="${reminder.id}" class="btn mb-2 btn-outline-success">
                               <i class="fe fe-delete fe-12 mr-4"></i>Delete
                              </a>` : ''}

                            </div>
                          </div>
                        </td>`;
                        
                        row.push(dropdown);
                        rows.push(row);
                    });
                }
    
                table.clear().draw();
                table.rows.add(rows).draw();
            }
        });
    }

    loadPetsInsideSelectForReminders();

    $('.selectpetforreminders').on('change', function() {
        var selectedpetId = $(this).find('option:selected').attr('petid');
        loadpetreminders(selectedpetId);
    });


    $('#newreminderbuttonreminderpage').on('click', function() {
        var petName = $('.selectpetforreminders').find('option:selected').attr('petname');
        var petId = $('.selectpetforreminders').find('option:selected').attr('petid');
        
        $('.btn-addreminder').attr('data-petid', petId);
        $('.addremindermodaltitle').html('Add Reminder For ' + petName);
       
    });

    function convertToYmdFormat(dateString) {
        var date = new Date(dateString);
        var year = date.getFullYear();
        var month = ('0' + (date.getMonth() + 1)).slice(-2);
        var day = ('0' + date.getDate()).slice(-2);
        return year + '/' + month + '/' + day;
    }



    $(document).on('click', '.btn-addreminder', function(e) {

        var petid = $(this).attr('data-petid');
        var reminder = $('#reminder').val();
        var reminder_type = $('#reminder_type').val();
        var date = $('#date').val();
        var date = convertToYmdFormat(date);

        var time = $('#time').val(); // The event time in format HH:MM AM/PM
        var reminder_prior_to = parseInt($('#reminder_prior_to').val(), 10); // Reminder prior to in hours

        function convertTo24HourTime(timeStr) {
            var [time, modifier] = timeStr.split(' ');
            var [hours, minutes] = time.split(':');
            
            if (hours === '12') {
                hours = '00';
            }
            
            if (modifier === 'PM') {
                hours = parseInt(hours, 10) + 12;
            }
            
            return `${hours}:${minutes}`;
        }

        function createDateTime(dateStr, timeStr) {
            var time24 = convertTo24HourTime(timeStr);
            var [year, month, day] = dateStr.split('/');
            var dateTimeStr = `${year}-${month}-${day}T${time24}:00`;
            return new Date(dateTimeStr);
        }
        
        var eventDateTime = createDateTime(date, time);

        if (isNaN(eventDateTime.getTime())) {
            console.error("Invalid date/time value");
        } else {
            eventDateTime.setHours(eventDateTime.getHours() - reminder_prior_to);
            
            // Format the adjusted Date object to YYYY/MM/DD HH:MM
            var reminderDate = eventDateTime.getFullYear() + '/' +
                               ('0' + (eventDateTime.getMonth() + 1)).slice(-2) + '/' +
                               ('0' + eventDateTime.getDate()).slice(-2);
            var reminderTime = ('0' + eventDateTime.getHours()).slice(-2) + ':' +
                               ('0' + eventDateTime.getMinutes()).slice(-2);
            
            
        }

        if (reminder_type == '' || date == '' || time == '' || reminder_prior_to == '' || reminder == '') {
            erroralert('Please fill all the fields');
            return;
        }

        $('#spinner').show();
        $(this).prop('disabled', true);

        $.ajax({
            url: 'process/reminders-process.php',
            type: 'POST',
            data: {
                petid: petid,
                reminder: reminder,
                reminder_type: reminder_type,
                date: date,
                time: time,
                reminder_prior_to: reminder_prior_to,
                reminderDate: reminderDate,
                reminderTime: reminderTime,
                action: 'add'
            },
            success: function(response) {

                $('#spinner').hide();
                $('#btn-addreminder').prop('disabled', false);

                if (response.status == 1) {
                    successalert(response.message);
                    $('#reminder').val('');
                    $('#addremindermodal').modal('hide'); 
                    loadpetreminders($('.selectpetforreminders').find('option:selected').attr('petid'));

                
                }
                else if (response.status == 2) {
                    erroralert(response.message);
                }
                else if (response.status == 3) {
                    erroralert(response.message);
                }
                else if (response.status == 4) {
                    erroralert(response.message);
                }
            }
    
        
        });
    
    });


    // Edit Reminder --------------------------------------------------------------------------------

    $(document).ready(function() {
        

        $(document).on('click', '.editreminder', function(e) {

            
            e.preventDefault();
            var reminderid = $(this).data('reminderid');
    

            $.ajax({
                url: 'process/reminders-process.php',
                type: 'POST',
                data: {
                    reminderid: reminderid,
                    action: 'get'
                },
                success: function(response) {
                    var data = JSON.parse(response);

                    if (data && data.length > 0) {

                        var reminderDetails = data[0];

                        $('.updatereminder_type').val(reminderDetails.type).trigger('change');
                        $('.updatedate').val(reminderDetails.date);
                        $('.updatetime').val(reminderDetails.time);
                        $('.updatereminder_prior_to').val(reminderDetails.remind_prior_to).trigger('change');
                        $('.updatereminder').val(reminderDetails.reminder);

                        $('#btn-updatereminder').attr('reminderid', reminderid); 

                        $('#editremindermodal').modal('show');
                    }
                }
            });
        });


        $(document).on('click', '#btn-updatereminder', function(e) {

            

            var reminderid = $(this).attr('reminderid');
            var reminder = $('#updatereminder').val();
            var reminder_type = $('#updatereminder_type').val();
            var date = $('#updatedate').val();
            var date = convertToYmdFormat(date);
    
            var time = $('#updatetime').val(); 
            var reminder_prior_to = parseInt($('#updatereminder_prior_to').val(), 10);
    
            function convertTo24HourTime(timeStr) {
                var [time, modifier] = timeStr.split(' ');
                var [hours, minutes] = time.split(':');
                
                if (hours === '12') {
                    hours = '00';
                }
                
                if (modifier === 'PM') {
                    hours = parseInt(hours, 10) + 12;
                }
                
                return `${hours}:${minutes}`;
            }
    
            function createDateTime(dateStr, timeStr) {
                var time24 = convertTo24HourTime(timeStr);
                var [year, month, day] = dateStr.split('/');
                var dateTimeStr = `${year}-${month}-${day}T${time24}:00`;
                return new Date(dateTimeStr);
            }
            
            var eventDateTime = createDateTime(date, time);
    
            if (isNaN(eventDateTime.getTime())) {
                console.error("Invalid date/time value");
            } else {
                eventDateTime.setHours(eventDateTime.getHours() - reminder_prior_to);
                
                // Format the adjusted Date object to YYYY/MM/DD HH:MM
                var reminderDate = eventDateTime.getFullYear() + '/' +
                                   ('0' + (eventDateTime.getMonth() + 1)).slice(-2) + '/' +
                                   ('0' + eventDateTime.getDate()).slice(-2);
                var reminderTime = ('0' + eventDateTime.getHours()).slice(-2) + ':' +
                                   ('0' + eventDateTime.getMinutes()).slice(-2);
                
                
            }
    
            if (reminder_type == '' || date == '' || time == '' || reminder_prior_to == '' || reminder == '') {
                erroralert('Please fill all the fields');
                return;
            }

    
            $.ajax({
                url: 'process/reminders-process.php',
                type: 'POST',
                data: {
                    reminderid: reminderid,
                    reminder: reminder,
                    reminder_type: reminder_type,
                    date: date,
                    time: time,
                    reminder_prior_to: reminder_prior_to,
                    reminderDate: reminderDate,
                    reminderTime: reminderTime,
                    action: 'update'
                },
                success: function(response) {

                    if (response.status == 1) {
                        successalert(response.message);
                        $('#reminder').val('');
                        $('#addremindermodal').modal('hide'); 
                        loadpetreminders($('.selectpetforreminders').find('option:selected').attr('petid'));
                        $('#editremindermodal').modal('hide');

                    }
                    else if (response.status == 2) {
                        erroralert(response.message);
                    }
        
                },
                error: function() {
                    $('#spinner').hide();
                    $('#btn-updatereminder').prop('disabled', false);
                    erroralert('An error occurred.');
                }
        
            
            });
        
        });
    });
    












    $(document).on('click', '.deletereminder', function(e) {
        e.preventDefault();
        var reminderid = $(this).data('reminderid');

        confirmdelete(function() {
            $.ajax({
                url: 'process/reminders-process.php',
                type: "POST",
                data: { reminderid: reminderid , action: 'delete'},
                dataType: 'json',
                success: function(response) {
                    if (response.status == 1 ) {
                        successalert(response.message);
                        loadpetreminders($('.selectpetforreminders').find('option:selected').attr('petid'));
                    } else {
                        erroralert(response.message);
                    }
                }
            });
        });
    });
});
