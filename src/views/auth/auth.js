    document.getElementById('registrationForm').addEventListener('submit', function (event) {
        event.preventDefault();
        
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const alertContainer = document.getElementById('alertContainer');

        if (password !== confirmPassword) {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger';
            alertDiv.role = 'alert';
            alertDiv.textContent = 'Passwords do not match.';
            alertContainer.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.remove();
            }, 3000);
        } else {
            this.submit();
        }
    });