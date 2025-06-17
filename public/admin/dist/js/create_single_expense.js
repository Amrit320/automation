$(document).ready(function () {
    // Event handlers for page loader
    $('.leftArrow, .rightArrow, .closeEditExpenseButton').on('click', togglePageLoader);

    // Initialize datepicker and configure settings
    function initializeDatepicker() {
        const datepickerConfig = {
            singleDatePicker: true,
            showDropdowns: true,
            maxYear: parseInt(moment().format("YYYY"), 10),
            locale: {
                format: 'DD/MM/YYYY'
            }
        };

        // Initialize for existing elements
        $('input[name="date"]').daterangepicker({
            autoUpdateInput: false,
            ...datepickerConfig
        });

        // Event handler for dynamically added elements
        $(document).on("focus", 'input[name="date"]', function () {
            $(this).daterangepicker(datepickerConfig);
        });
    }

    // Initialize datepicker and select2
    initializeDatepicker();
    $("select").select2();

    // Fetch draft reports with optional selection
    function fetchDraftReports(selectedReport = null) {
        togglePageLoader();
        $.ajax({
            url: routes.getDraftReport,
            method: "GET",
            success: function (response) {
                let selectReport = $("#editSelectReport");
                selectReport.select2("destroy").empty()
                    .append(`<option value="">Select Record</option>`);

                response.reports.forEach(function (report) {
                    selectReport.append(
                        `<option value="${report.report_number}" ${report.report_number == selectedReport ? "selected" : ""}>
                            ${report.report_title} - #${report.report_number}
                        </option>`
                    );
                });

                selectReport.select2();
                togglePageLoader();
            },
            error: function () {
                alert("Failed to load draft Records.");
                togglePageLoader();
            }
        });
    }

    // Create new report handler
    $(".createNewReportSubmitButton").click(function () {
        let form = $("#createReportForm");
        let submitButton = $(this);
        let loadingButton = submitButton.next();

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

    // Expense type change handler
    $(document).on('change', '#reportType', function () {
        let expenseTypeId = $(this).val();

        if (expenseTypeId) {
            togglePageLoader();
            $.ajax({
                url: routes.getFieldsWithTypeID,
                type: 'POST',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                data: { expense_type_id: expenseTypeId },
                success: function (fields) {
                    const categorySelect = $('#reportCategory');
                    categorySelect.select2("destroy").empty()
                        .append('<option value="" disabled>Select Category</option>');

                    fields.forEach(field => {
                        categorySelect.append(`<option value="${field.id}">${field.field_name}</option>`);
                    });

                    categorySelect.select2();
                    togglePageLoader();
                },
                error: function (xhr) {
                    console.error("Error fetching fields:", xhr.responseText);
                    togglePageLoader();
                }
            });
        }
    });

    // Toggle submit button state
    function toggleSubmitExpenseButton(isSubmitting) {
        $(".createExpenseLoadingButton").toggle(isSubmitting);
        $(".createExpenseButton").toggle(!isSubmitting);
    }

    // File upload handling
    $(document).on("change", ".fileInput", function (e) {
        const files = e.target.files;
        if (files.length > 0) {
            uploadFiles(files, this);
        }
    });

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
                togglePageLoader();

                const fileName = response[0].filename;
                const fileExtension = fileName.split('.').pop().toLowerCase();
                const filePath = routes.attachmentFiles + "/" + fileName;

                // Update hidden input
                $('.attachment_file').attr("value", fileName);

                // Create preview based on file type
                let newContent = '';
                if (["jpg", "jpeg", "png", "webp"].includes(fileExtension)) {
                    newContent = `<div class="uploadContainer h-100"><img src="${filePath}" alt="Attachment Image" style="width: 100%;"></div>`;
                } else if (fileExtension === "pdf") {
                    newContent = `<div class="uploadContainer h-100"><iframe src="${filePath}" width="100%" height="650px"></iframe></div>`;
                } else {
                    newContent = `<div class="uploadContainer h-100"><a href="${filePath}" target="_blank">Download Attachment</a></div>`;
                }
                newContent += `<button class="deleteUploadAttachment btn btn-outline-danger mt-2 p-2" type="button" style="display: block;" id="deleteUploadAttachmentButton" title="Delete Attachment"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon m-0 p-0"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></button>`;

                $(".attachmentsContainer").html(newContent);

                // Image Scanner start here 
                scanner(filePath, inputElement);
            },
            error: function (xhr, status, error) {
                togglePageLoader();
                const response = JSON.parse(xhr.responseText);
                showAlert(response.error, "error");
            }
        });
    }

    // Delete attachment handler
    $(document).on("click", "#deleteUploadAttachmentButton", function () {
        const uploadHtml = `<div class="uploadContainer h-100"><label for="uploadFile" class="w-100 h-100 cursor-pointer d-flex flex-column align-items-center justify-content-center text-primary"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-upload"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 9l5 -5l5 5" /><path d="M12 4l0 12" /></svg><div class="text-center mt-2">Click to Upload Attachment</div></label><input type="file" class="fileInput" id="uploadFile" hidden></div>`;

        $('.attachmentsContainer').empty().append(uploadHtml);

        // Clear value of attachment file input
        $('.attachment_file').val('');
    });

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

            // Proceed with scanning
            togglescannerLoader(); // Show the scanner loader

            $.ajax({
                url: routes.fileScanner,
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

                        const dateInput = $('#editDate');
                        const merchantInput = $('#editMerchant');
                        const amountInput = $('#editAmount');
                        const gstInput = $('#editGST');

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

        // "Not Now" button already dismisses the modal via data-bs-dismiss, so no action needed
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

    // Update expense form validation and submission
    $(document).on("click", ".createExpenseButton", function (e) {
        e.preventDefault();

        const $form = $("#createExpenseForm");
        let isValid = true;
        const expenseData = [];
        // Reset previous validation states
        $form.find("[required]").removeClass('is-invalid');

        // Validate required fields

        $form.find("[required]").each(function () {
            const $field = $(this);
            const fieldName = $field.attr("name");

            if (!$field.val()) {
                isValid = false;
                $field.addClass('is-invalid');

                $('html, body').animate({
                    scrollTop: $field.offset().top - 100
                }, 500);

                // 🧠 Field-specific error message
                let message = "This field is required";

                switch (fieldName) {
                    case "attachment":
                        message = "Attachment is Required";
                        break;
                    case "report":
                        message = "Please select a Records";
                        break;
                    case "date":
                        message = "Date is required";
                        break;
                    case "type":
                        message = "Expense type is Required";
                        break;
                    case "category":
                        message = "Please select a Category";
                        break;
                    case "merchant":
                        message = "Merchant name is Required";
                        break;
                    case "amount":
                        message = "Amount is Required";
                        break;
                }

                showAlert(message, "error"); // 🛎️ Show alert
                return false; // stop on first error
            } else {
                $field.removeClass('is-invalid');
            }
        });

        if (!isValid) return;

        // Gather data
        const reportId = $form.find("select[name='report']").val();
        const date = $form.find("input[name='date']").val();
        const attachment = $form.find("input[name='attachment']").val();
        const type = $form.find("select[name='type']").val();
        const category = $form.find("select[name='category']").val();
        const merchant = $form.find("input[name='merchant']").val();
        const description = $form.find("input[name='description']").val();
        const amount = $form.find("input[name='amount']").val();
        const gst = $form.find("input[name='gst']").is(":checked") ? 1 : 0;
        const advance_amount = $form.find("select[name='advance_amount']").val();

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

        const requestData = {
            reportId: reportId,
            expenseData: expenseData
        };

        $(".createExpenseButton").hide();
        $(".createExpenseLoadingButton").show();

        // Send AJAX request
        toggleSubmitExpenseButton(true);

        $.ajax({
            url: routes.storeMultipleExpense,
            type: "POST",
            data: requestData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function (response) {
                if (response.status === "success") {
                    handleSuccessfulSubmission(response);
                    $(".loadingCreateExpenseButton").hide();
                } else {
                    showAlert(response.message, "error");
                    $(".createExpenseButton").show();
                    $(".loadingCreateExpenseButton").hide();
                }
                toggleSubmitExpenseButton(false);
            },
            error: function (error) {
                showAlert("Something went wrong. Please try again.", "error");
                $(".createExpenseButton").show();
                $(".loadingCreateExpenseButton").hide();
                toggleSubmitExpenseButton(false);
            }
        });
    });

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

    // Toggle Scanner Loader Function
    function togglescannerLoader() {
        const $scannerLoader = $("#scannerLoader");

        if ($scannerLoader.css("display") === "none" || $scannerLoader.css("display") === "") {
            $scannerLoader.css("display", "flex");
        } else {
            $scannerLoader.css("display", "none");
        }
    }

});