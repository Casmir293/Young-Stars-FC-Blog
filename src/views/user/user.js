// Image upload
document.querySelector('.upload-img').addEventListener('click', function() {
    document.querySelector('#imageInput').click();
});

document.querySelector('#imageInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imagePreview = document.querySelector('#imagePreview');
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});

// Loading button
function loadButton() {  
    document.querySelector('#save-photo').classList.add('d-none');
    document.querySelector('#loading-photo').classList.remove('d-none');
}

// Check matching password
function changePassword(event) {
    event.preventDefault();

    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const alertContainer = document.getElementById('alertContainer');
    const submitBtn = document.getElementById('save-password');
    const loadingBtn = document.getElementById('loading-password');

    alertContainer.innerHTML = '';

    if (newPassword !== confirmPassword) {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-danger';
        alertDiv.role = 'alert';
        alertDiv.textContent = 'Passwords do not match.';
        alertContainer.appendChild(alertDiv);

        setTimeout(() => {
            alertDiv.remove();
        }, 6000);

        submitBtn.classList.remove('d-none');
        loadingBtn.classList.add('d-none');
        return false;
    } else {
        submitBtn.classList.add('d-none');
        loadingBtn.classList.remove('d-none');

        document.getElementById('passwordForm').submit();
    }

    return true;
}


