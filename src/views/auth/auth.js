    // Validate Registration Form
    document.getElementById('registrationForm').addEventListener('submit', function (event) {
        event.preventDefault();
        
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const alertContainer = document.getElementById('alertContainer');
        const submitButton = document.getElementById('submit-form');
        const loadingButton = document.getElementById('loading');

        // check password match
        if (password !== confirmPassword) {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger';
            alertDiv.role = 'alert';
            alertDiv.textContent = 'Passwords do not match.';
            alertContainer.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.remove();
            }, 6000);
        } else {
            submitButton.classList.add('d-none');
            loadingButton.classList.remove('d-none');
            this.submit();
        }
        });

    // // Successful Registration Alert
    //  successAlert =()=> {
    //     const successToast = document.getElementById('success-toast');

    //     setTimeout(() => {
    //         successToast.remove();
    //     }, 6000);
    // }

    
    