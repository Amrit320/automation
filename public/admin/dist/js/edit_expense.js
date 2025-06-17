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
                    .append(`<option value="">Select Report</option>`);

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
                alert("Failed to load draft reports.");
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
                showAlert("Error creating report", "error");
            },
            complete: function () {
                submitButton.show();
                loadingButton.hide();
            }
        });
    });

    // Expense type change handler
    $(document).on('change', '#editType', function () {
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
                    const categorySelect = $('#editCategory');
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

                $(".attachmentsContainer").html(newContent);
            },
            error: function (xhr, status, error) {
                togglePageLoader();
                const response = JSON.parse(xhr.responseText);
                showAlert(response.error, "error");
            }
        });
    }

    // Delete file handler
    $(document).on("click", ".deleteFile", function () {
        const label = $(this).closest(".fileUploadLabel");
        const img = label.find("img");

        // Reset image to placeholder
        img.attr("src", img.attr("data-src"));
        label.removeClass("show");

        // Clear file inputs
        $(this).parent().parent().find(".attachment_file").val("");
        $(this).parent().parent().find(".fileInput").val("");
    });

    // View file handler
    $(document).on("click", ".viewFile", function () {
        const fileName = $(this).parent().parent().find(".attachment_file").val();

        if (!fileName) {
            showAlert("No file to view.", "warning");
            return;
        }

        const filePath = routes.attachmentFiles + "/" + fileName;
        const modalBody = $("#fileViewModal .modal-body");
        modalBody.empty();

        // Display content based on file type
        if (fileName.toLowerCase().endsWith(".pdf")) {
            modalBody.append(`<iframe src="${filePath}" width="100%" height="600px" style="border: none;"></iframe>`);
        } else {
            modalBody.append(`<img src="${filePath}" width="70%" alt="Attachment" class="img-fluid" />`);
        }

        $("#fileViewModal").modal("show");
    });

    // Update expense form validation and submission
    $(document).on("click", ".updateExpenseButton", function (e) {
        e.preventDefault();

        const $form = $("#updateExpenseForm");
        let isValid = true;

        // Validate required fields
        $form.find("[required]").each(function () {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');

                $('html, body').animate({
                    scrollTop: $(this).offset().top - 100
                }, 500);

                return false; // Break the loop
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (isValid) {
            $(".updateExpenseButton").hide();
            $(".updateExpenseLoadingButton").show();
            $form.submit();
        }
    });
});