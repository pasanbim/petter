$(document).ready(function() {
    function loadPets() {
        $.ajax({
            url: 'process/pets-process.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
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
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fe fe-plus-square fe-12 mr-4"></i>Add Record
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fe fe-bell fe-12 mr-4"></i>Setup Alert
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fe fe-edit fe-12 mr-4"></i>Edit
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
                                        <h4 class="card-title mt-3 my-0">${pet.name}</h4>
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

    // Load pets on page load
    loadPets();

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
                            
                        }
                        if (response.status == 2) {
                            erroralert(response.message);
                        }
                    }
                }
            });
        });
    });
});
