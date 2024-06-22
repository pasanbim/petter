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
        var selectedOption = $(this).find(':selected');
        var selectedpetId = selectedOption.attr('petid');

        $.ajax({
            url: 'process/reminders-process.php',
            type: 'POST',
            data: {
                petid: selectedpetId,
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

                        // Create the base row data
                        var row = [
                            reminder.petid,
                            reminder.type,
                            reminder.date,
                            reminder.time,
                            reminder.reminder,
                            reminder.remind_prior_to + ' hour(s)',
                            `<td><span class="badge badge-pill p-1 px-2 ${badgeClass}" style="color:white">${reminder.status.charAt(0).toUpperCase() + reminder.status.slice(1)}</span></td>`
                        ];
                    
                        // Create the dropdown with conditional "Add New Reminder" option
                        var dropdown = `
                        <td>
                          <div class="dropdown" style = "text-align:center">
                            <button class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" type="button" id="dr${index}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu dropdown-menu-center" aria-labelledby="dr${index}">
                            ${reminder.status.toLowerCase() === 'active' ?`
                              <a class="dropdown-item" href="" class="addrecord btn mb-2 btn-outline-success" id="addrecord" data-toggle="modal" data-target="#addrecordmodal">
                               <i class="fe fe-edit fe-12 mr-4"></i>Edit
                              </a>
                              <a class="dropdown-item" href="" class="addrecord btn mb-2 btn-outline-success" id="addrecord" data-toggle="modal" data-target="#addrecordmodal">
                               <i class="fe fe-delete fe-12 mr-4"></i>Delete
                              </a>` : ''}
                              ${reminder.status.toLowerCase() === 'sent' ? `
                              <a class="dropdown-item" href="" class="addrecord btn mb-2 btn-outline-success" id="addrecord" data-toggle="modal" data-target="#addrecordmodal">
                               <i class="fe fe-bell fe-12 mr-4"></i>New Reminder
                              </a>` : ''}
                            </div>
                          </div>
                        </td>`;
                    
                        // Append the dropdown to the row
                        row.push(dropdown);
                    
                        // Add the row to the rows array
                        rows.push(row);
                    });
                    
                }

                // Clear existing rows
                table.clear().draw();

                // Add new rows
                table.rows.add(rows).draw();
            }
        });
    });
    

    
    
    function convertToYmdFormat(dateString) {
        var date = new Date(dateString);
        var year = date.getFullYear();
        var month = ('0' + (date.getMonth() + 1)).slice(-2);
        var day = ('0' + date.getDate()).slice(-2);
        return year + '/' + month + '/' + day;
    }


    //Ajax call to save reminders

    $(document).on('click', '.btn-addreminder', function(e) {
        e.preventDefault();
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


        if (reminder_type == '' || date == '' || time == '') {
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
                remindpriorto : reminder_prior_to,
                action: 'add'
            },
            success: function(response) {

                $('#spinner').hide();
                $('#btn-addreminder').prop('disabled', false);

                if (response.status == 1) {
                    successalert(response.message);
                    $('#reminder').val('');
                    $('#addremindermodal').modal('hide');    
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
});




