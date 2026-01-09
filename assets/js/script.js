// Basic JavaScript for Fashion Store Management System

// Confirm delete action
function confirmDelete() {
    return confirm('Are you sure you want to delete this item?');
}

// Simple form validation
function validateForm(formId) {
    const form = document.getElementById(formId);
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');

    for (let input of inputs) {
        if (!input.value.trim()) {
            alert('Please fill in all required fields.');
            input.focus();
            return false;
        }
    }
    return true;
}

// Add event listeners when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Add confirmation to delete links
    const deleteLinks = document.querySelectorAll('a[href*="delete"]');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirmDelete()) {
                e.preventDefault();
            }
        });
    });

    // Add form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(form.id)) {
                e.preventDefault();
            }
        });
    });
});