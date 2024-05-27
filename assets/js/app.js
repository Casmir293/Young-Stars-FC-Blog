/**
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registrationForm');
    const submitButton = document.getElementById('submit-form');
    const loadingButton = document.getElementById('loading');

    form.addEventListener('submit', function (event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Hide the submit button and show the loading button
        submitButton.classList.add('d-none');
        loadingButton.classList.remove('d-none');

        // Optionally, you can submit the form after a short delay or perform an AJAX request
        // Example of submitting the form after a short delay
        setTimeout(function() {
            form.submit();
        }, 500); // Adjust the delay as needed
    });
});
*/

loadButton =()=> {
    const submitButton = document.getElementById('submit-form');
    const loadingButton = document.getElementById('loading');

    submitButton.classList.add('d-none');
    loadingButton.classList.remove('d-none');
}
