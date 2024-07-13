$(document).ready(function() {
    function loadNotifications() {
        $.ajax({
            url: "./process/notifications.php",
            type: "POST",
            data: { loadNotifications: true },
            dataType: 'json',
            success: function(response) {
                if (response.numberofnotifications > 0) {
                    $(".notification-dot").addClass("dot-md");
                }
                var notificationsHtml = '';
                response.notification.forEach(function(notification) {
                    notificationsHtml += `
                <div class="list-group-item bg-transparent">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="fe fe-bell fe-24"></span>
                        </div>
                        <div class="col">
                            <small><strong>${notification.message}</strong></small>
                            <small class="badge badge-pill badge-light text-muted">${notification.time}</small>
                        </div>
                    </div>
                </div>`;
                });
                $(".notifications-list").html(notificationsHtml);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error fetching notifications: ' + textStatus);
            }
        });
    }

    loadNotifications();

    $("#notification-icon").on("click", function() {
        loadNotifications();
    });



    $(".clear-notifications").on("click", function() {

        $.ajax({
            url: "./process/notifications.php",
            type: "POST",
            data: { clearNotifications: true },
            dataType: 'json',
            success: function(response) {
    
                if (response.status == 1) {

                    $(".notification-dot").removeClass("dot-md");

                }
    
                
            }
        });
    
    
    });


});




