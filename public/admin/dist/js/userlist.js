
/**
 * User List Management JavaScript
 * Handles all user list interactions including view, edit, delete, and status updates
 */

document.addEventListener('DOMContentLoaded', function () {
    // Add click event to user names in the table
    const userNameCells = document.querySelectorAll('tbody tr td:nth-child(2)'); // Select the name column cells

    userNameCells.forEach(cell => {
        cell.style.cursor = 'pointer';
        cell.classList.add('text-primary');

        // Add click event listener
        cell.addEventListener('click', function () {
            // Extract user ID from the row (from the delete or edit button's data attribute)
            const row = this.closest('tr');
            const deleteButton = row.querySelector('.rowDeleteButton');
            if (deleteButton) {
                const userId = deleteButton.getAttribute('data-id');
                openViewModal(userId);
            }
        });
    });

    // Select all delete buttons on the page
    initializeDeleteButtons();
    initializeDeleteForms();
    initializeSubmitButtons();
});

/**
 * Sets up click events on delete buttons
 */
function initializeDeleteButtons() {
    document.querySelectorAll('.rowDeleteButton').forEach(button => {
        // Add a click event listener to each delete button
        button.addEventListener('click', function () {
            // Get the user ID from the data-id attribute of the clicked button
            const userId = this.getAttribute('data-id');

            // Get the user's name from the data-name attribute of the clicked button
            const userName = this.getAttribute('data-name');

            // Set the user ID in the hidden input field of the delete form
            document.getElementById('deleteUserId').value = userId;

            // Get a reference to the delete form
            const form = document.getElementById('deleteUserForm');

            // Update the form's action URL by replacing the ':id' placeholder with the actual user ID
            const newAction = form.action.replace(/\/[^\/]*$/, '/' + userId);
            form.action = newAction;

            // Update the confirmation message in the modal to include the user's name
            document.querySelector('.deleteModalMessageField').textContent =
                `Are you sure you want to delete user ${userName}?`;

            // Update the text of the submit button to clearly indicate the action
            document.getElementById('deleteModalSubmitButton').textContent = 'Delete User';

            // Create a Bootstrap modal instance for the confirmation dialog
            const modal = new bootstrap.Modal(document.getElementById('deleteExpenseTypeModal'));

            // Display the modal to the user
            modal.show();
        });
    });
}

/**
 * Set up confirmation for delete forms
 */
function initializeDeleteForms() {
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this user?')) {
                this.submit();
            }
        });
    });
}

/**
 * Initialize submit buttons to show loading state
 */
function initializeSubmitButtons() {
    $('.submitButton').on('click', function (e) {
        let form = $(this).closest('form')[0];
        if (form.checkValidity()) {
            $(this).hide();
            $(this).siblings('.loadingButton').show();
        } else {
            e.preventDefault();
            form.reportValidity();
        }
    });
}

/**
 * Open the edit modal for a user
 * @param {string} userId - The ID of the user to edit
 */
function openEditModal(userId) {
    togglePageLoader();

    // Check if ROUTES is defined and has the necessary property
    if (typeof ROUTES === 'undefined' || !ROUTES.SHOW_USER) {
        console.error('ROUTES object is not properly defined');
        togglePageLoader();
        showAlert('Configuration error. Please contact administrator.', "error");
        return;
    }

    const url = ROUTES.SHOW_USER.replace(':id', userId);
    const form = document.getElementById('editUserForm');
    form.reset();

    // Fetch user data via AJAX with proper headers
    fetch(url, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const user = data.data;

                // Populate the form inputs
                document.getElementById('edit_user_id').value = user.user_id;
                document.getElementById('edit_first_name').value = user.first_name;
                document.getElementById('edit_last_name').value = user.last_name;
                document.getElementById('edit_email_id').value = user.email_id;
                document.getElementById('edit_role').value = user.role;
                document.getElementById('edit_department_id').value = user.department_id;
                document.getElementById('edit_branch_id').value = user.branch_id;
                document.getElementById('edit_manager_id').value = user.manager_id || '';
                document.getElementById('edit_emp_office_id').value = user.emp_office_id || '';
                document.getElementById('edit_account_number').value = user.account_number || '';
                document.getElementById('edit_debit_ac_number').value = user.debit_ac_number || '';
                document.getElementById('edit_crn_remark').value = user.crn_remark || '';
                document.getElementById('edit_receiver_ifsc').value = user.receiver_ifsc || '';
                document.getElementById('edit_receiver_ac_type').value = user.receiver_ac_type || '';
                document.getElementById('edit_email_body').value = user.email_body || '';
                document.getElementById('edit_approved_by').value = user.approved_by || '';
                document.getElementById('edit_name_in_bank').value = user.name_in_bank || '';

                // Update the form action dynamically
                const form = document.getElementById('editUserForm');
                const newAction = form.action.replace(/\/[^\/]*$/, '/' + user.user_id);
                form.action = newAction;

                // Show the modal
                const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
                modal.show();
                togglePageLoader();
            } else {
                togglePageLoader();
                let errorMessage = 'Failed to fetch user data.';
                showAlert(errorMessage, "error");
            }
        })
        .catch(error => {
            togglePageLoader();
            console.error('Error details:', error);
            let errorMessage = 'Error fetching user data: ' + error;
            showAlert(errorMessage, "error");
        });
}

/**
 * Open the view modal for a user
 * @param {string} userId - The ID of the user to view
 */
function openViewModal(userId) {
    togglePageLoader();

    // Check if ROUTES is defined and has the necessary property
    if (typeof ROUTES === 'undefined' || !ROUTES.SHOW_USER) {
        console.error('ROUTES object is not properly defined');
        togglePageLoader();
        showAlert('Configuration error. Please contact administrator.', "error");
        return;
    }

    const url = ROUTES.SHOW_USER.replace(':id', userId);

    // Fetch user data via AJAX with proper headers
    fetch(url, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const user = data.data;

                // Debug: Log the user object to see all available properties
                console.log('User data received:', user);

                // Populate the view modal with user data
                document.getElementById('view_first_name').value = user.first_name || 'N/A';
                document.getElementById('view_last_name').value = user.last_name || 'N/A';
                document.getElementById('view_email_id').value = user.email_id || 'N/A';
                document.getElementById('view_role').value = user.role ? (user.role.charAt(0).toUpperCase() + user.role.slice(1)) : 'N/A';

                // Updated to use department_name instead of just the ID
                document.getElementById('view_department_id').value = user.department_id;

                // Updated to use branch_name instead of just the ID
                document.getElementById('view_branch_name').value = user.branch_name || 'N/A';
                document.getElementById('view_branch_id').value = user.branch_id;

                document.getElementById('view_manager').value = user.manager_name || 'N/A';
                document.getElementById('view_emp_id').value = user.emp_office_id || 'N/A';
                document.getElementById('view_status').value = user.status ? (user.status.charAt(0).toUpperCase() + user.status.slice(1)) : 'N/A';
                document.getElementById('view_account_number').value = user.account_number || 'N/A';
                document.getElementById('view_debit_ac_number').value = user.debit_ac_number || 'N/A';
                document.getElementById('view_crn_remark').value = user.crn_remark || 'N/A';
                document.getElementById('view_receiver_ifsc').value = user.receiver_ifsc || 'N/A';
                document.getElementById('view_receiver_ac_type').value = user.receiver_ac_type || 'N/A';
                document.getElementById('view_approved_by').value = user.approved_by_name || 'N/A';
                document.getElementById('view_name_in_bank').value = user.name_in_bank || 'N/A';
                document.getElementById('view_email_body').value = user.email_body || 'N/A';

                // Format dates if available
                document.getElementById('view_created_at').value = user.created_at ? new Date(user.created_at).toLocaleDateString() : 'N/A';
                document.getElementById('view_updated_at').value = user.updated_at ? new Date(user.updated_at).toLocaleDateString() : 'N/A';

                // Show the modal
                const modal = new bootstrap.Modal(document.getElementById('viewUserModal'));
                modal.show();
                togglePageLoader();
            } else {
                togglePageLoader();
                let errorMessage = 'Failed to fetch user data.';
                showAlert(errorMessage, "error");
            }
        })
        .catch(error => {
            togglePageLoader();
            console.error('Error details:', error);
            let errorMessage = 'Error fetching user data: ' + error;
            showAlert(errorMessage, "error");
        });
}

/**
 * Update the status of a user
 * @param {string} userId - The ID of the user to update
 */
function updateUserStatus(userId) {
    // Get the selected status from the dropdown
    let status = document.getElementById(`user_status_${userId}`).value;

    // Check if ROUTES is defined and has the necessary property
    if (typeof ROUTES === 'undefined' || !ROUTES.UPDATE_STATUS) {
        console.error('ROUTES object is not properly defined');
        showAlert('Configuration error. Please contact administrator.', "error");
        return;
    }

    // Construct the URL to call the updated route
    const url = ROUTES.UPDATE_STATUS.replace(':id', userId);

    // Prepare the AJAX request
    fetch(url, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            status: status
        }),
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                let successMessage = data.message;
                showAlert(successMessage, "success");
            } else {
                let errorMessage = data.message;
                showAlert(errorMessage, "error");
            }
        })
        .catch(error => {
            console.error('Error details:', error);
            let errorMessage = "Error updating status: " + error;
            showAlert(errorMessage, "error");
        });
}