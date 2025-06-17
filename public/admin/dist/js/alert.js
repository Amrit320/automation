// Function to fade out an element
function fadeOut(element, duration = 500, callback) {
    let opacity = 1; // Initial opacity
    const step = 50 / duration; // Calculate step for each frame

    const fade = () => {
        opacity -= step;
        if (opacity <= 0) {
            element.style.opacity = 0;
            element.style.display = "none";
            if (callback) callback();
        } else {
            element.style.opacity = opacity;
            requestAnimationFrame(fade);
        }
    };
    fade();
}

// Function to handle fading alerts sequentially
function handleAlerts() {
    const alerts = document.querySelectorAll(".alertSection .alert");

    let delay = 5000; // Start with 5 seconds delay for the first alert

    alerts.forEach((alert, index) => {
        setTimeout(() => {
            fadeOut(alert, 500, () => {
                // Remove the alert from the DOM after fading out
                alert.remove();
            });
        }, delay + index * 1000); // Add 1 second delay for each subsequent alert
    });

    // Attach click event listeners to cancel buttons
    document.querySelectorAll(".cancelButton").forEach((button) => {
        button.addEventListener("click", () => {
            const parentAlert = button.closest(".alert");
            if (parentAlert) {
                fadeOut(parentAlert, 500, () => {
                    parentAlert.remove();
                });
            }
        });
    });
}

// Execute the function when the DOM content is fully loaded
document.addEventListener("DOMContentLoaded", handleAlerts);
