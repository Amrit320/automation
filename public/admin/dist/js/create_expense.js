$(document).ready(function () {
    // Initialize common components
    initializeComponents();

    // Handle cancel button
    $(".cancelCreateExpenseButton").on("click", togglePageLoader);

    // HANDLE NAV TABS
    $(".nav-tabs a").on("click", function () {
        $(".error-item").removeClass("error-item");
    });

    // HANDLE CREATE EXPENSE EVENTS
    setupExpenseHandlers();

    // HANDLE FILE UPLOAD
    setupFileHandlers();

    // HANDLE REPORT PREVIEW
    setupReportPreview();
});

// Initialize common UI components
function initializeComponents() {
    // Initialize datepicker exactly as original
    initializeDatepicker();

    // Initialize select2 for all select elements
    $("select").select2();
}

// Datepicker initialization - preserving original implementation exactly
function initializeDatepicker() {
    $('input[name="date"]').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        maxYear: parseInt(moment().format("YYYY"), 10),
        locale: {
            format: 'DD/MM/YYYY' // Set your desired format here
        }
    });
}

// Reinitialize when new elements are added dynamically
$(document).on("focus", 'input[name="date"]', function () {
    $(this).daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        maxYear: parseInt(moment().format("YYYY"), 10),
        locale: {
            format: 'DD/MM/YYYY' // Set your desired format here
        }
    });
});

// Set up expense-related event handlers
function setupExpenseHandlers() {
    // Add new expense row
    $(document).on("click", ".addMoreExpense", function () {
        addExpenseRow($(this));
    });

    // Delete expense row
    $(document).on("click", ".deleteExpenseRow", function () {
        deleteExpenseRow($(this));
    });

    // Handle expense submission
    $(document).on("click", "#expenseSubmitButton", function () {
        submitExpense();
    });

    // Handle report selection change
    $(document).on("change", "#selectReport", function () {
        $("#expensePreviewButton").toggle($(this).val() !== "");
    });

    // Setup report creation
    setupReportCreation();
}

// Add a new expense row
function addExpenseRow($button) {
    const $table = $button.parent().find("table");
    const $tbody = $table.find(".expenseTableBody");

    // Destroy select2 before cloning
    $table.find("select").select2("destroy");

    // Clone the last row
    const $lastRow = $tbody.find("tr:last").clone();
    const uniqueId = "file" + new Date().getTime();

    // Reset all inputs
    $lastRow.find("input, select").each(function () {
        if ($(this).is(":checkbox")) {
            $(this).prop("checked", false);
        } else {
            $(this).val("");
        }
    });

    // Set default "no" option for advance_amount select
    $lastRow.find("select[name='advance_amount']").val("0");

    // Update serial number
    $lastRow.find(".sr_no").text(parseInt($tbody.find("tr:last").find(".sr_no").text()) + 1);

    // Reset the file upload
    $lastRow.find(".file_upload label img").attr("src", routes.imageUploadPlaceholder);
    $lastRow.find(".file_upload input[name='attachment']").attr("id", uniqueId);
    $lastRow.find(".file_upload label").attr("for", uniqueId);

    // Clear any error indicators
    $lastRow.find(".error-item").removeClass("error-item");
    $lastRow.find(".file_upload .show").removeClass("show");

    // Add the row to the table
    $tbody.append($lastRow);

    // Reinitialize select2
    $table.find("select").select2();
}

// Delete an expense row
function deleteExpenseRow($button) {
    const $tbody = $button.closest("tbody");
    const $rows = $tbody.find("tr");

    if ($rows.length > 1) {
        $button.closest("tr").remove();

        // Update serial numbers
        $tbody.find(".sr_no").each(function (index) {
            $(this).text(index + 1);
        });
    } else {
        // Clear the last remaining row instead of deleting
        $rows.find("select").select2("destroy");
        $rows.find("input[type=checkbox]").prop("checked", false);
        $rows.find("input, select").val("");
        $rows.find(".file_upload label img").attr("src", routes.imageUploadPlaceholder);
        $rows.find(".file_upload .show").removeClass("show");
        $rows.find("select[name='advance_amount']").val("0");
        $rows.find("select").select2();
        showAlert("At least one row must remain. Data has been cleared.", "success");
    }
}

// Set up handlers for report creation
function setupReportCreation() {
    // Create new report button click
    $(".createNewReportSubmitButton").click(function () {
        const form = $("#createReportForm");
        const submitButton = $(this);
        const loadingButton = submitButton.next();

        submitButton.hide();
        loadingButton.show();

        $.ajax({
            url: form.attr("action"),
            method: "POST",
            data: form.serialize(),
            success: function (response) {
                $("#createReportModal").modal("hide");
                fetchDraftReports(response.report_number);
                form[0].reset();
                showAlert(response.message, "success");
            },
            error: function () {
                showAlert("Error creating record", "error");
            },
            complete: function () {
                submitButton.show();
                loadingButton.hide();
            }
        });
    });
}

// Fetch draft reports for the dropdown
function fetchDraftReports(selectedReport = null) {
    togglePageLoader();

    $.ajax({
        url: routes.getDraftReport,
        method: "GET",
        success: function (response) {
            let selectReport = $("#selectReport");
            selectReport.empty();
            selectReport.append(`<option value="">Select Record</option>`);

            response.reports.forEach(function (report) {
                const isSelected = report.report_number == selectedReport ? "selected" : "";
                selectReport.append(
                    `<option value="${report.report_id}" ${isSelected}>${report.report_title} - #${report.report_number}</option>`
                );
            });

            $("#expensePreviewButton").show();
            togglePageLoader();
        },
        error: function () {
            showAlert("Failed to load draft records.", "error");
            togglePageLoader();
        }
    });
}

// Set up file upload handling
function setupFileHandlers() {
    // File input change event
    $(document).on("change", ".fileInput", function (e) {
        if (e.target.files.length > 0) {
            uploadFiles(e.target.files, this);
        }
    });

    // Delete file button
    $(document).on("click", ".deleteFile", function () {
        const label = $(this).closest(".fileUploadLabel");
        const img = label.find("img");

        img.attr("src", img.attr("data-src"));
        label.removeClass("show");

        // Clear input values
        $(this).parent().parent().find(".attachment_file").val("");
        $(this).parent().parent().find(".fileInput").val("");
    });

    // View file button
    $(document).on("click", ".viewFile", function () {
        const fileName = $(this).parent().parent().find(".attachment_file").val();

        if (!fileName) {
            showAlert("No file to view.", "warning");
            return;
        }

        const filePath = routes.attachmentFiles + "/" + fileName;
        const modalBody = $("#fileViewModal .modal-body");

        modalBody.html("");

        if (fileName.toLowerCase().endsWith(".pdf")) {
            modalBody.append(`
                <iframe src="${filePath}" width="100%" height="600px" style="border: none;"></iframe>`);
        } else {
            modalBody.append(`
                <img src="${filePath}" width="70%" alt="Attachment" class="img-fluid" />`);
        }

        $("#fileViewModal").modal("show");
    });
}

// Upload files to server
function uploadFiles(files, inputElement) {
    togglePageLoader();

    const formData = new FormData();
    for (let i = 0; i < files.length; i++) {
        formData.append("files[]", files[i]);
    }

    $.ajax({
        url: routes.uploadFiles,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function (response) {
            // console.log(response);
            togglePageLoader();

            const fileName = response[0].filename;
            const filePath = routes.attachmentFiles + "/" + response[0].filename;
            const fileType = routes.attachmentFiles + "/" + response[0].filetype;

            // Get UI elements
            const label = $(inputElement).parent().find(".fileUploadLabel");
            const img = label.find("img");
            const attachmentInput = $(inputElement).parent().find(".attachment_file");

            // Update UI
            attachmentInput.val(fileName);
            img.attr("data-src", img.attr("src"));

            if (fileType.includes("pdf")) {
                img.attr("src", routes.imagePDFPlaceholder);
            } else {
                img.attr("src", filePath);
            }

            label.addClass("show");

            // 👇 Now call the OCR scanner
            scanner(filePath, inputElement);
        },
        error: function (xhr, status, error) {
            togglePageLoader();
            const response = JSON.parse(xhr.responseText);
            showAlert(response.error, "error");
        }
    });
}

// Scanner function for OCR
function scanner(fileUrl, inputElement) {
    // Show the modal first
    $('#scanPermissionModal').modal('show');

    // Unbind any previous click handlers to avoid duplicate triggers
    $('#scanPermissionModal .btn-primary').off('click');
    $('#scanPermissionModal .btn-secondary').off('click');

    // If user clicks "Yes, Proceed"
    $('#scanPermissionModal .btn-primary').on('click', function () {
        $('#scanPermissionModal').modal('hide'); // Hide the modal

        // Now proceed with scanning
        togglescannerLoader(); // Show the scanner loader

        $.ajax({
            url: routes.fileScanner, // Your Laravel scanner route
            type: "POST",
            data: {
                url: fileUrl,
                type: 1
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function (res) {
                if (res.success) {
                    const ocrData = res.data;

                    const dateInput = $(inputElement).parent().parent().find("input[name='date']");
                    const merchantInput = $(inputElement).parent().parent().find("input[name='merchant']");
                    const amountInput = $(inputElement).parent().parent().find("input[name='amount']");
                    const gstInput = $(inputElement).parent().parent().find("input[name='gst']");

                    if (ocrData.invoice_date) {
                        const formattedDate = formatToDDMMYYYY(ocrData.invoice_date);
                        if (formattedDate) {
                            dateInput.val(formattedDate);
                        }
                    }

                    if (ocrData.supplier_name) {
                        merchantInput.val(ocrData.supplier_name);
                    }

                    if (ocrData.total_amount) {
                        const formattedAmount = formatPlainNumber(ocrData.total_amount);
                        if (formattedAmount !== null) {
                            amountInput.val(formattedAmount);
                        }
                    }

                    if (ocrData.total_tax_amount) {
                        gstInput.prop("checked", true);
                    }

                    togglescannerLoader(); // Hide the scanner loader
                } else {
                    console.error("OCR failed:", res.error);
                    showAlert("OCR failed: " + res.error, "error");
                    togglescannerLoader(); // Hide the scanner loader
                }
            },
            error: function (xhr) {
                console.error("Scanner error:", xhr);
                showAlert("OCR scan failed. Please try again.", "error");
                togglescannerLoader(); // Hide the scanner loader
            }
        });
    });

    // If user clicks "Not Now", just close the modal (already handled by data-bs-dismiss)
}


function formatToDDMMYYYY(dateStr) {
    // Try to parse the input date string
    const date = new Date(dateStr);

    // If date is invalid, return null
    if (isNaN(date.getTime())) {
        return null;
    }

    // Extract parts
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
    const year = date.getFullYear();

    return `${day}/${month}/${year}`;
}

function formatPlainNumber(value) {
    // Remove anything except digits and decimal point
    const numeric = parseFloat(String(value).replace(/[^0-9.]/g, ''));

    if (isNaN(numeric)) {
        return null;
    }

    // Return with exactly two decimal places, no commas
    return numeric.toFixed(2);
}


// Toggle submit button state
function toggleSubmitExpenseButton(isSubmitting) {
    $(".expenseLoadingButton").toggle(isSubmitting);
    $("#expenseSubmitButton").toggle(!isSubmitting);
}

// Activate a specific tab
function activaTab(tab) {
    $('.nav-tabs a[href="#' + tab + '"]').tab("show");
}

// Submit expense data
function submitExpense() {
    toggleSubmitExpenseButton(true);

    const reportId = $("#selectReport").val();
    const expenseData = [];
    let hasError = false;

    // Validate and collect expense data following the original logic exactly
    $(".expense-row").each(function (index) {
        let $row = $(this);

        // Remove previous error states
        $row.removeClass("error-row");
        $row.find("td").removeClass("error-item").width();
        $row.find(".error-msg").remove();

        // Get field values
        let date = $row.find("input[name='date']").val();
        let attachment = $row.find("input[name='attachment_file']").val();
        let type = $row.find("input[name='type']").data("id");
        let category = $row.find("select[name='category']").val();
        let merchant = $row.find("input[name='merchant']").val();
        let description = $row.find("input[name='description']").val();
        let gst = $row.find("input[name='gst']").prop("checked") ? 1 : 0;
        let amount = $row.find("input[name='amount']").val();
        let advance_amount = $row.find("select[name='advance_amount']").val();

        // Check if any field is filled - exactly as original
        let anyFilled =
            date ||
            attachment ||
            category ||
            merchant ||
            description ||
            gst ||
            amount;

        if (anyFilled) {
            let rowHasError = false;

            // Check required fields and show errors
            if (!date) {
                $row.find("input[name='date']")
                    .parent()
                    .addClass("error-item");
                showAlert("Date is required", "error");
                rowHasError = true;
            }
            if (!attachment) {
                $row.find("input[name='attachment']")
                    .parent()
                    .addClass("error-item");
                showAlert("Attachment required", "error");
                rowHasError = true;
            }
            if (!category) {
                $row.find("select[name='category']")
                    .parent()
                    .addClass("error-item");
                showAlert("Category required", "error");
                rowHasError = true;
            }
            if (!merchant) {
                $row.find("input[name='merchant']")
                    .parent()
                    .addClass("error-item");
                showAlert("Merchant required", "error");
                rowHasError = true;
            }
            if (!amount) {
                $row.find("input[name='amount']")
                    .parent()
                    .addClass("error-item");
                showAlert("Amount required", "error");
                rowHasError = true;
            }

            if (rowHasError) {
                $row.addClass("error-row");
                hasError = true;
                activaTab($row.find("input[name='type']").attr("data-tab")); // Activate the tab with the error
                toggleSubmitExpenseButton(false);
                return false; // Stop loop
            }

            // Push valid data
            expenseData.push({
                date,
                attachment,
                type,
                category,
                merchant,
                description,
                gst,
                amount,
                advance_amount
            });
        }
    });

    if (hasError) {
        toggleSubmitExpenseButton(false);
        return;
    }

    if (reportId === "") {
        showAlert("Please select a record to link the expense to.", "error");
        toggleSubmitExpenseButton(false);
        return;
    }

    const requestData = {
        reportId: reportId,
        expenseData: expenseData
    };

    // Submit to server
    $.ajax({
        url: routes.storeMultipleExpense,
        type: "POST",
        data: JSON.stringify(requestData),
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function (response) {
            if (response.status === "success") {
                handleSuccessfulSubmission(response);
            } else {
                toggleSubmitExpenseButton(false);
                showAlert(response.message, "error");
            }
        },
        error: function (error) {
            handleSubmissionError(error);
            toggleSubmitExpenseButton(false);
        }
    });
}

// Handle successful expense submission
function handleSuccessfulSubmission(response) {
    const reportNumber = response.reportNumber;

    if (reportNumber) {
        $("#successExpenseModalTitle").text("Record Created");
        $("#successExpenseModalMessage").text(
            "Your expense has been saved and linked to record number " + reportNumber + "."
        );
    } else {
        $("#successExpenseModalTitle").text("Expense Created");
        $("#successExpenseModalMessage").text("Your expense has been successfully created.");
    }

    $("#successExpenseModal").modal("show");

    // Start redirect countdown
    let seconds = 4;
    const timer = setInterval(function () {
        seconds--;
        $("#redirectTimerText").text("Redirecting in " + seconds + " sec...");
        if (seconds <= 0) {
            clearInterval(timer);
            window.location.href = routes.expenseList;
        }
    }, 1000);

    toggleSubmitExpenseButton(false);
}

// Handle errors in expense submission
function handleSubmissionError(error) {
    if (error.status === 422 && error.responseJSON?.errors) {
        const messages = [];
        Object.values(error.responseJSON.errors).forEach(errorGroup => {
            errorGroup.forEach(msg => messages.push(msg));
        });
        showAlert(messages.join("<br>"), "error");
    } else {
        showAlert("An error occurred while submitting the expense.", "error");
    }
}

// Set up report preview functionality
function setupReportPreview() {
    $(document).on("click", "#expensePreviewButton", function () {
        const reportId = $("#selectReport").val();
        const expenseData = [];
        let hasError = false;

        // Use exact same validation logic as in submitExpense
        $(".expense-row").each(function (index) {
            let $row = $(this);

            // Remove previous error states
            $row.removeClass("error-row");
            $row.find("td").removeClass("error-item").width();
            $row.find(".error-msg").remove();

            // Get field values
            let date = $row.find("input[name='date']").val();
            let attachment = $row.find("input[name='attachment_file']").val();
            let type = $row.find("input[name='type']").data("id");
            let category = $row.find("select[name='category']").val();
            let merchant = $row.find("input[name='merchant']").val();
            let description = $row.find("input[name='description']").val();
            let gst = $row.find("input[name='gst']").prop("checked") ? 1 : 0;
            let amount = $row.find("input[name='amount']").val();
            let advance_amount = $row.find("select[name='advance_amount']").val();

            // Check if any field is filled - exactly as original
            let anyFilled =
                date ||
                attachment ||
                category ||
                merchant ||
                description ||
                gst ||
                amount;

            if (anyFilled) {
                let rowHasError = false;

                // Check required fields and show errors
                if (!date) {
                    $row.find("input[name='date']").parent().addClass("error-item");
                    showAlert("Date is required", "error");
                    rowHasError = true;
                }
                if (!attachment) {
                    $row.find("input[name='attachment']").parent().addClass("error-item");
                    showAlert("Attachment required", "error");
                    rowHasError = true;
                }
                if (!category) {
                    $row.find("select[name='category']").parent().addClass("error-item");
                    showAlert("Category required", "error");
                    rowHasError = true;
                }
                if (!merchant) {
                    $row.find("input[name='merchant']").parent().addClass("error-item");
                    showAlert("Merchant required", "error");
                    rowHasError = true;
                }
                if (!amount) {
                    $row.find("input[name='amount']").parent().addClass("error-item");
                    showAlert("Amount required", "error");
                    rowHasError = true;
                }

                if (rowHasError) {
                    $row.addClass("error-row");
                    hasError = true;
                    activaTab($row.find("input[name='type']").attr("data-tab")); // Activate the tab with the error
                    return false; // Stop loop
                }

                // Push valid data
                expenseData.push({
                    date,
                    attachment,
                    type,
                    category,
                    merchant,
                    description,
                    gst,
                    amount,
                    advance_amount
                });
            }
        });

        if (hasError) {
            return;
        }

        const requestData = {
            reportId: reportId,
            expenseData: expenseData
        };

        togglePageLoader();

        $.ajax({
            url: routes.previewReport,
            type: "POST",
            data: JSON.stringify(requestData),
            contentType: "application/json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function (response) {
                togglePageLoader();

                if (response.status === "success") {
                    renderReportPreview(response);
                    $('#previewExpenseModal').modal('show');
                } else {
                    showAlert(response.message, "error");
                }
            },
            error: function (error) {
                togglePageLoader();
                handleSubmissionError(error);
            }
        });
    });
}

// Render the expense report preview
function renderReportPreview(response) {
    const reportData = response.reportData;
    const userData = response.userData;
    const expenseData = response.expenseData;

    // Set report title
    $("#report_name").text(reportData.report_title + " - #" + reportData.report_number);

    // Set current date
    const today = new Date();
    const formattedDate = today.getDate().toString().padStart(2, '0') + '.' +
        (today.getMonth() + 1).toString().padStart(2, '0') + '.' +
        today.getFullYear();
    $("#report_date").text(formattedDate);

    // Set employee details
    $("#report_emp_name").text(userData.first_name + " " + userData.last_name);
    $("#report_emp_id").text(userData.emp_office_id);

    const role = userData.role;
    const capitalizedRole = role.charAt(0).toUpperCase() + role.slice(1).toLowerCase();
    $("#report_emp_designation").text(capitalizedRole);

    // Set expense items
    const $table = $("#report_expense_items");
    const $totalDiv = $("#report_expenses_total");
    let totalAmount = 0;

    $table.empty();
    $totalDiv.empty();

    expenseData.forEach(function (group, groupIndex) {
        // Add group heading
        $table.append(`
            <tr class="fw-bold">
              <td>${groupIndex + 1}</td>
              <td colspan="6">${group.type.expense_type_name}</td>
            </tr>
        `);

        // Add expense items
        group.expenses.forEach(function (expense, expenseIndex) {
            const gstStatus = expense.gst ? "YES" : "NO";
            const advance_amount = expense.advance_amount == 1 ? "YES" : "NO";
            const amount = parseFloat(expense.amount) || 0;
            totalAmount += amount;

            $table.append(`
                <tr>
                  <td class="p-1">${groupIndex + 1}.${expenseIndex + 1}</td>
                  <td class="p-1">${expense.category.field_name}</td>
                  <td class="p-1">${expense.date || ''}</td>
                  <td class="p-1">${expense.merchant || ''}</td>
                  <td class="p-1">${expense.description || ''}</td>
                  <td class="p-1">${gstStatus}</td>
                  <td class="p-1">${advance_amount}</td>
                  <td class="p-1">${amount.toLocaleString("en-IN", { minimumFractionDigits: 2 })}</td>
                </tr>
            `);
        });
    });

    // Add total row
    $totalDiv.append(`
        <tr class="fw-bold">
          <td colspan="2">Total Expenses</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>${totalAmount.toLocaleString("en-IN", { minimumFractionDigits: 2 })}</td>
        </tr>
    `);
}

//Toggle Scanner Loader Function
function togglescannerLoader() {
    const $scannerLoader = $("#scannerLoader");

    if ($scannerLoader.css("display") === "none" || $scannerLoader.css("display") === "") {
        $scannerLoader.css("display", "flex");
    } else {
        $scannerLoader.css("display", "none");
    }
}
