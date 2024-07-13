$(document).ready(function() {
    var map;
    var infoWindow;

    function initMap(response) {
        var userLatLng = {lat: parseFloat(response.user.latitude), lng: parseFloat(response.user.longitude)};

        map = new google.maps.Map(document.getElementById('map'), {
            center: userLatLng,
            zoom: 12
        });

        // Add a marker for the user's location with a custom icon
        new google.maps.Marker({
            position: userLatLng,
            map: map,
            title: "Your Location",
            icon: {
                url: './assets/images/home-marker.svg', 
                scaledSize: new google.maps.Size(32, 32) 
            }

        });

        // Close the info window when clicking on the map
        map.addListener('click', function() {
            if (infoWindow) {
                infoWindow.close();
            }
        });

        // Loop through the vet locations and place markers
        response.vets.forEach(function(vet) {
            var vetLatLng = {lat: parseFloat(vet.latitude), lng: parseFloat(vet.longitude)};
            var marker = new google.maps.Marker({
                position: vetLatLng,
                map: map,
                title: vet.name,
                icon: {
                    url: './assets/images/icon.png', 
                    scaledSize: new google.maps.Size(32, 32) 
                }
            });

            // Styled info window content with Make an Appointment button
            var contentString = `
                <div style="font-family: Arial, sans-serif; font-size: 14px;">
                    <div style="font-weight: bold; font-size: 16px; margin-bottom: 5px;">Dr ${vet.name}</div><br>
                    <div style="margin-bottom: 5px;">
                        <strong>Address:</strong> ${vet.address}
                    </div>
                    <div style="margin-bottom: 5px;">
                        <strong>Phone: </strong>${vet.phone}
                    </div>
                    <div style="margin-bottom: 5px;">
                        <strong>Distance:</strong> ${parseFloat(vet.distance).toFixed(2)} km
                    </div>
                    <button class="btn btn-primary" onclick="makeAppointment('${vet.id}')">Make an Appointment</button>
                </div>`;

            // Create a new info window without close button
            google.maps.event.addListener(marker, 'click', (function(marker) {
                return function() {
                    if (infoWindow) {
                        infoWindow.close();
                    }
                    infoWindow = new google.maps.InfoWindow({
                        content: contentString
                    });
                    infoWindow.open(map, marker);
                    // Apply custom CSS to hide the close button
                    google.maps.event.addListener(infoWindow, 'domready', function() {
                        var iwCloseBtn = document.querySelector('.gm-style-iw button');
                        if (iwCloseBtn) {
                            iwCloseBtn.style.display = 'none';
                        }
                    });
                }
            })(marker));
        });
    }

    function GetVetInfo() {
        var selectedRadius = $(".radius").val();
    
        $.ajax({
            url: "./process/vets-process.php",
            type: "POST",
            data: { GetVetInfo: true, radius: selectedRadius },
            dataType: 'json',
            success: function(response) {
                if (response && response.vets.length > 0) {
                    initMap(response);
                } else {
                    console.log("No vet locations found.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching vet info:", status, error);
            }
        });
    }

    // Function to handle making an appointment
    window.makeAppointment = function(vetId) { 
        window.location.href = `./appointment.php?vetId=${vetId}`;
        
    }

    // Initial call
    GetVetInfo();

    // Bind change event to the dropdown
    $(".radius").change(function() {
        GetVetInfo();
    });
});
