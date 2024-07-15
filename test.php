<?php
// session_start(); // Uncomment if you need session variables

// Database connection
include './includes/config.php';

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Test Calendar | Petter</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }

        .fc-toolbar-title {
            color: #ff7c00; /* Custom color for the title */
        }

        .fc-button-primary {
            background-color: #ff7c00; /* Custom color for the buttons */
            border-color: #ff7c00;
        }

        .fc-event {
            background-color: #ff7c00 !important; /* Custom color for events */
            border-color: #ff7c00 !important;
        }
    </style>
</head>

<body>
    <h1>Test Calendar</h1>
    <div id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                events: './process/fetch_appointments.php' // URL to fetch events from
            });

            calendar.render();
        });
    </script>
</body>

</html>
