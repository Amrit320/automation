document.querySelectorAll(".delete-form").forEach((form) => {
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        
        let formToSubmit = this; // Store reference to the form

        $("#deleteModalSubmitButton").text("Delete " + $(this).data("name"));
        $("#deleteBranchModal").modal("show");
        $(".deleteModalMessageField").html(
            "Do you really want to delete <b>" + $(this).data("name") + "</b> Branch? What you've done cannot be undone."
        );

        // Ensure the click event is not bound multiple times
        $("#deleteModalSubmitButton").off("click").on("click", function () {
            $(this).hide(); // Hide the submit button
            $(".deleteloadingButton").show(); // Show the loading button
            formToSubmit.submit(); // Submit the form
        });
    });
});


function openEditModal(branchId) {
    const url = route.showbranch.replace(":id", branchId);
    const form = document.getElementById("editBranchForm");
    togglePageLoader();
    form.reset();
    // Fetch branch data via AJAX
    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                const branch = data.data;

                // Populate the form inputs
                document.getElementById("edit_branch_id").value =
                    branch.branch_id;
                document.getElementById("edit_name").value = branch.branch_name;
                document.getElementById("prev_branch_name").value = branch.branch_name;

                // Update the form action dynamically
                const form = document.getElementById("editBranchForm");
                form.action = form.action.replace(":id", branch.branch_id);

                // Show the modal
                const modal = new bootstrap.Modal(
                    document.getElementById("editBranchModal")
                );
                modal.show();
                togglePageLoader();
            } else {
                showAlert("Failed to fetch branch data.", "error");
                togglePageLoader();
            }
        })
        .catch((error) => {
            console.error("Error fetching branch data:", error);
        });
}

$("#editBranchButton").click(function (e) {
    e.preventDefault();
    $(this).hide();
    $(".editloadingButton").show();
    $("#editBranchForm").submit();
});

$("#addBranchButton").click(function (e) {
    e.preventDefault();
    $(this).hide();
    $(".addloadingButton").show();
    $("#addUserForm").submit();
});



document.addEventListener('DOMContentLoaded', function () {
    $('input[name="branch_name"]').focusout(function () {
        let branch_name = $(this).val();

        if (branch_name.trim() === '') {
            return;
        }

        $.ajax({
            
            url: route.validateBranch, 
            type: "POST",
            data: {
                name: branch_name,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $("#addBranchButton").prop("disabled",false);
                $('#name').removeClass('is-invalid').addClass('is-valid');
                $('#branchFeedback').text(response.message).css('color', 'green');
            },
            error: function (xhr) {
                $("#addBranchButton").prop("disabled",true);
                $('#name').removeClass('is-valid').addClass('is-invalid');
                $('#branchFeedback').text(xhr.responseJSON.message).css('color', 'red');
            }
        });
    });
});