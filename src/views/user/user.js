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

        function loadButton() {
            document.querySelector('#save-photo').classList.add('d-none');
            document.querySelector('#loading-photo').classList.remove('d-none');
        }