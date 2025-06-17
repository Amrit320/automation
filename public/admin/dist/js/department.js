
// DELETE FORM SCRIPT 
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        let formToSubmit = this; // Store reference to the form
        $("#deleteModalSubmitButton").text("Delete " + $(this).data("name"));
        $("#deleteDepartmentModal").modal("show");
        $(".deleteModalMessageField").html(
            "Do you really want to delete <b>" + $(this).data("name") + "</b> Department? What you've done cannot be undone."
        );

        $("#deleteModalSubmitButton").off("click").on("click", function () {
            $(this).hide(); // Hide the submit button
            $(".deleteloadingButton").show(); // Show the loading button
            formToSubmit.submit(); // Submit the form
        });
    });
});

// CREATE FORM SCRIPT
$("#createDepartmentForm").on("submit", function (e) {
    e.preventDefault();
    $("#createNewDepartmentButton").hide();
    $(".createloadingButton").show();
    this.submit();
})
// EDIT FORM SCRIPT
$("#editDepartmentForm").on("submit", function (e) {
    e.preventDefault();
    $("#updateDepartmentButton").hide();
    $(".updateloadingButton").show();
    this.submit();
})

function openEditModal(DepartmentId) {
    const url = route.showdepartment.replace(':id', DepartmentId);
    const form = document.getElementById('editDepartmentForm');
    togglePageLoader();
    form.reset();
    // Fetch Department data via AJAX
    fetch(url)
        .then(response => response.json())
        .then(data => {

            if (data.success) {

                const Department = data.data;
                // Populate the form inputs
                document.getElementById('edit_department_id').value = Department.department_id;
                document.getElementById('edit_name').value = Department.department_name;
                document.getElementById('edit_branch_id').value = Department.branch_id;
                document.getElementById('edit_department_head').value = Department.department_head;
                document.getElementById('edit_status').value = Department.status;

                // Update the form action dynamically
                const form = document.getElementById('editDepartmentForm');
                form.action = form.action.replace(':id', Department.department_id);

                // Show the modal
                const modal = new bootstrap.Modal(document.getElementById('editDepartmentModal'));
                modal.show();
                togglePageLoader();
            } else {
                showAlert('Failed to fetch Department data.', 'error');
                togglePageLoader();
            }
        })
        .catch(error => {
            console.error('Error fetching Department data:', error);
        });
}

// Open View Modal Script
function openViewModal(DepartmentId) {
    const url = route.showdepartment.replace(':id', DepartmentId);
    const form = document.getElementById('editDepartmentForm');
    togglePageLoader();
    form.reset();
    // Fetch Department data via AJAX
    fetch(url)
        .then(response => response.json())
        .then(data => {

            if (data.success) {

                const Department = data.data;
                // Populate the form inputs
                document.getElementById('view_name').value = Department.department_name;
                document.getElementById('view_branch_id').value = Department.branch_id;
                document.getElementById('view_department_head').value = Department.department_head;
                document.getElementById('view_status').value = Department.status;

                // Show the modal
                const modal = new bootstrap.Modal(document.getElementById('viewDepartmentModal'));
                modal.show();
                togglePageLoader();
            } else {
                showAlert('Failed to fetch Department data.', 'error');
                togglePageLoader();
            }
        })
        .catch(error => {
            console.error('Error fetching Department data:', error);
        });
}

document.addEventListener('DOMContentLoaded', function () {
    $('input[name="department_name"]').focusout(function () {
        let branch_name = $(this).val();

        if (branch_name.trim() === '') {
            return;
        }

        $.ajax({
            
            url: route.validateDept, 
            type: "POST",
            data: {
                name: branch_name,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $("#createNewDepartmentButton").prop("disabled",false);
                $('#name').removeClass('is-invalid').addClass('is-valid');
                $('#deptFeedback').text(response.message).css('color', 'green');
            },
            error: function (xhr) {
                $("#createNewDepartmentButton").prop("disabled",true);
                $('#name').removeClass('is-valid').addClass('is-invalid');
                $('#deptFeedback').text(xhr.responseJSON.message).css('color', 'red');
            }
        });
    });
});