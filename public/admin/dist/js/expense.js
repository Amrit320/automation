$(document).ready(function () {
    // Page loader toggle for expense actions
    $(document).on("click", ".openEditExpense, .addNewExpenseItemButton, .draft_report_item", togglePageLoader);

    // Open canvas for expense item edit
    $(document).on("click", ".expenseCardItem .card-body .content .leftSide .expense-details", function () {
        $("#editExpenseItemOffcanvas").offcanvas("show");
    });

    // DATEPICKER CONFIGURATION
    const datepickerConfig = {
        singleDatePicker: true,
        showDropdowns: true,
        maxYear: parseInt(moment().format("YYYY"), 10)
    };

    // Initialize datepicker for existing elements
    $('input[name="select_date"]').daterangepicker(datepickerConfig);

    // Initialize datepicker for dynamically added elements
    $(document).on("focus", 'input[name="select_date"]', function () {
        $(this).daterangepicker(datepickerConfig);
    });

    // Initialize Select2 when edit offcanvas is shown
    $("#editExpenseItemOffcanvas").on("shown.bs.offcanvas", function () {
        $(".select2").select2({
            dropdownParent: $("#editExpenseItemOffcanvas")
        });
    });

    // DELETE MULTIPLE EXPENSES
    function deleteMultipleExpense(selectedIds) {
        if (selectedIds.length === 0) {
            alert('Please select at least one expense to delete.');
            return;
        }

        if (!confirm('Are you sure you want to delete the selected expenses?')) {
            return;
        }

        togglePageLoader();
        $.ajax({
            url: routes.deleteMultiple,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                expense_ids: selectedIds
            },
            success: function (response) {
                window.location.href = updateQueryStringParameter(window.location.href, 'expense', 'all');
            },
            error: function (xhr) {
                showAlert('Something went wrong while deleting expenses.');
                togglePageLoader();
            }
        });
    }

    function updateQueryStringParameter(uri, key, value) {
        let re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        let separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        } else {
            return uri + separator + key + "=" + value;
        }
    }

    // Delete selected expenses button
    $(document).on('click', '#deleteSelectedExpenseButton', function () {
        const selectedIds = $('.selectExpenseItemInput:checked').map(function () {
            return $(this).val();
        }).get();

        deleteMultipleExpense(selectedIds);
    });

    // Delete expense from other tab
    $(document).on('click', '.deleteExpenseOtherTab', function () {
        deleteMultipleExpense([$(this).data('id')]);
    });

    // FILE VIEW
    $(document).on("click", ".viewFile", function () {
        const fileName = $(this).data("attachment");

        if (!fileName) {
            showAlert("error", "No file to view.");
            return;
        }

        const filePath = routes.attachmentFiles + "/" + fileName;
        const modalBody = $("#fileViewModal .modal-body");

        modalBody.empty();

        if (fileName.toLowerCase().endsWith(".pdf")) {
            modalBody.append(`<iframe src="${filePath}" width="100%" height="600px" style="border: none;"></iframe>`);
        } else {
            modalBody.append(`<img src="${filePath}" width="70%" alt="Attachment" class="img-fluid" />`);
        }

        $("#fileViewModal").modal("show");
    });

    // SORT BY FILTER 
    $("#sortByDraftUnreported").change(function () {
        const sortByValue = $(this).val();
        const currentUrl = new URL(window.location.href);
        const params = new URLSearchParams(currentUrl.search);
        params.set('sort_by', sortByValue);
        currentUrl.search = params.toString();
        window.location.href = currentUrl.toString();
    });


    // Create a "No Results" message
    const noResultMessage = $('<div class="no-results text-center mt-4" style="display:none;">No results found</div>');
    $('#draft_report_tab').append(noResultMessage);

    // On input typing
    $('#searchInputDraftReport').on('keyup', function () {
        const searchText = $(this).val().toLowerCase().trim();
        let hasVisibleCard = false;

        $('#draft_report_tab .expenseCardItem').each(function () {
            const title = $(this).find('.reportTitleDraftReport').text().toLowerCase();
            const number = $(this).find('.reportNumberDraftReport').text().toLowerCase();
            const dateRange = $(this).find('.dateRangeDraftReport').text().toLowerCase();
            const noOfExpenses = $(this).find('.noOfExpensesDraftReport').text().toLowerCase();

            // Clean the numbers by removing commas
            const totalAmount = $(this).find('.totalAmountDraftReport').text().toLowerCase().replace(/,/g, '');
            const reimbursementAmount = $(this).find('.reimbursableAmountDraftReport').text().toLowerCase().replace(/,/g, '');

            // Match the search
            if (
                title.includes(searchText) ||
                number.includes(searchText) ||
                dateRange.includes(searchText) ||
                noOfExpenses.includes(searchText) ||
                totalAmount.includes(searchText) ||
                reimbursementAmount.includes(searchText)
            ) {
                $(this).show();
                hasVisibleCard = true;
            } else {
                $(this).hide();
            }
        });

        if (hasVisibleCard) {
            noResultMessage.hide();
        } else {
            noResultMessage.show();
        }
    });
});