$(window).on('pageshow', function (event) {
    if (event.originalEvent.persisted) {
        // If coming back via browser back button
        window.location.reload(); // Prevents old scripts from rerunning
    }
});

function showAlert(message, type) {
    const alertHtml = type === 'error' ?
        `<div class="alert errorAlert" id="errorAlert">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                          fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-circle-x">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path
                              d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-6.489 5.8a1 1 0 0 0 -1.218 1.567l1.292 1.293l-1.292 1.293l-.083 .094a1 1 0 0 0 1.497 1.32l1.293 -1.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -1.497l-1.292 -1.293l1.292 -1.293l.083 -.094a1 1 0 0 0 -1.497 -1.32l-1.293 1.292l-1.293 -1.292l-.094 -.083z" />
                      </svg>
                      <span class="alertText">${message}</span>
                      <div class="cancelButton">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M18 6l-12 12" />
                              <path d="M6 6l12 12" />
                          </svg>
                      </div>
                  </div>` :
        `<div class="alert successAlert" id="successAlert">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                          class="icon icon-tabler icons-tabler-filled icon-tabler-rosette-discount-check">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path
                              d="M12.01 2.011a3.2 3.2 0 0 1 2.113 .797l.154 .145l.698 .698a1.2 1.2 0 0 0 .71 .341l.135 .008h1a3.2 3.2 0 0 1 3.195 3.018l.005 .182v1c0 .27 .092 .533 .258 .743l.09 .1l.697 .698a3.2 3.2 0 0 1 .147 4.382l-.145 .154l-.698 .698a1.2 1.2 0 0 0 -.341 .71l-.008 .135v1a3.2 3.2 0 0 1 -3.018 3.195l-.182 .005h-1a1.2 1.2 0 0 0 -.743 .258l-.1 .09l-.698 .697a3.2 3.2 0 0 1 -4.382 .147l-.154 -.145l-.698 -.698a1.2 1.2 0 0 0 -.71 -.341l-.135 -.008h-1a3.2 3.2 0 0 1 -3.195 -3.018l-.005 -.182v-1a1.2 1.2 0 0 0 -.258 -.743l-.09 -.1l-.697 -.698a3.2 3.2 0 0 1 -.147 -4.382l.145 -.154l.698 -.698a1.2 1.2 0 0 0 .341 -.71l.008 -.135v-1l.005 -.182a3.2 3.2 0 0 1 3.013 -3.013l.182 -.005h1a1.2 1.2 0 0 0 .743 -.258l.1 -.09l.698 -.697a3.2 3.2 0 0 1 2.269 -.944zm3.697 7.282a1 1 0 0 0 -1.414 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" />
                      </svg>
                      <span class="alertText">${message}</span>
                      <div class="cancelButton">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M18 6l-12 12" />
                              <path d="M6 6l12 12" />
                          </svg>
                      </div>
                  </div>`;

    $('.alertSection').append(alertHtml);

    handleAlerts();
}

// delete msg 
$(function () {
    // Handle click event for ".rowDeleteButton"
    $('.rowDeleteButton').on('click', function () {
        // Get data-id and data-name from the clicked button
        const id = $(this).data('id');
        const name = $(this).data('name');

        // Update the modal message
        const modalMessage = `Do you really want to remove <b>${name}</b> Type? 
                      It will remove all the dynamic fields in this expense type with their Field Options. 
                      What you've done cannot be undone.
                      `;
        $('.deleteModalMessageField').html(modalMessage);

        $("#deleteModalSubmitButton").text("Delete " + name)
        // Set the value in the hidden input field
        $('#deleteModalExpenseTypeID').val(id);

        // Open the modal
        $('#deleteExpenseTypeModal').modal('show');
    });
});

function togglePageLoader() {
    const pageLoader = document.getElementById("pageLoader");
    if (pageLoader.style.display === "none" || pageLoader.style.display === "") {
        pageLoader.style.display = "flex";
    } else {
        pageLoader.style.display = "none";
    }
}

// Call immediately when page starts loading
togglePageLoader(); // Show loader

// Then call again when the full page is loaded
$(window).on('load', function () {
    togglePageLoader(); // Hide loader
});

// password toggle 
// Select the required elements
const toggleButton = document.querySelector('.password-toggle');
const passwordInput = document.querySelector('.passwordInput');
const eyeIcon = document.querySelector('.icon-tabler-eye');
const eyeOffIcon = document.querySelector('.icon-tabler-eye-off');

// Add event listener to the button
toggleButton.addEventListener('click', () => {
    // Toggle the input type between 'password' and 'text'
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text'; // Show the password
        eyeIcon.style.display = 'none'; // Hide the "eye" icon
        eyeOffIcon.style.display = 'inline'; // Show the "eye-off" icon
    } else {
        passwordInput.type = 'password'; // Hide the password
        eyeIcon.style.display = 'inline'; // Show the "eye" icon
        eyeOffIcon.style.display = 'none'; // Hide the "eye-off" icon
    }
});

document.addEventListener('DOMContentLoaded', function () {
    $('.passwordInput').focusout(function () {
        let passLength = $(this).val();

        if (passLength.trim() === '') {
            return;
        }

        if (passLength.length < 8) {
            $("#addUserBtn").prop("disabled", true);
            $('#passchecker').removeClass('is-valid').addClass('is-invalid');
            $('#passFeedback').text('Password lenght should be min 8 charecter').css('color', 'red');
        } else {
            $("#addUserBtn").prop("disabled", false);
            $('#passchecker').removeClass('is-invalid').addClass('is-valid');
            $('#passFeedback').text('Valid Password').css('color', 'green');
        }
        // alert(passLength.length)
    })
})

// Preload images with data-src attribute
function loadImages() {
    $('img[data-src]').each(function () {
        let $img = $(this);
        let dataSrc = $img.data('src');

        let testImg = new Image();
        testImg.onload = function () {
            $img.attr('src', dataSrc);
        };
        testImg.onerror = function () {
            console.warn('Failed to load:', dataSrc);
        };
        testImg.src = dataSrc;
    });
}


// toggle comment box 
$(document).ready(function () {
    // Initial check on page load
    toggleCommentBox($('#approvalStatus').val());

    // Listen for changes in the dropdown
    $('#approvalStatus').on('change', function () {
        const selected = $(this).val();
        toggleCommentBox(selected);
    });

    function toggleCommentBox(value) {
        if (value === 'rejected') {
            $('#commentBox').slideDown();
        } else {
            $('#commentBox').slideUp();
        }
    }
});

// sticky select all section on scroll to top
document.addEventListener('DOMContentLoaded', function() {
    const stickyBar = document.getElementById('stickySelectionBar');
    const originalPosition = stickyBar.offsetTop;

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > originalPosition) {
            stickyBar.classList.add('sticky-active');
        } else {
            stickyBar.classList.remove('sticky-active');
        }
    });
});

// print summary 
function printDiv(divId) {
    var divContents = document.getElementById(divId).innerHTML;
    var a = window.open('', '', 'height=800, width=800');
    a.document.write('<html>');
    a.document.write('<head><title>Print Summary</title>');
    a.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">'); // agar styling chahiye to
    a.document.write('</head><body>');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.print();
}