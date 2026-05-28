// assets/js/validation.js
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form[data-validate="true"]');

    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');

            requiredFields.forEach(field => {
                const errorMessage = field.nextElementSibling;
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = 'var(--danger-color)';
                    if (errorMessage && errorMessage.classList.contains('error-message')) {
                        errorMessage.style.display = 'block';
                        errorMessage.textContent = 'Ce champ est requis.';
                    }
                } else {
                    field.style.borderColor = 'var(--border-color)';
                    if (errorMessage && errorMessage.classList.contains('error-message')) {
                        errorMessage.style.display = 'none';
                    }
                }
            });

            // Validation spécifique au mot de passe de confirmation
            const pass = form.querySelector('input[name="password"]');
            const confirmPass = form.querySelector('input[name="password_confirm"]');
            if (pass && confirmPass && pass.value !== confirmPass.value) {
                isValid = false;
                confirmPass.style.borderColor = 'var(--danger-color)';
                const errorMessage = confirmPass.nextElementSibling;
                if (errorMessage && errorMessage.classList.contains('error-message')) {
                    errorMessage.style.display = 'block';
                    errorMessage.textContent = 'Les mots de passe ne correspondent pas.';
                }
            }

            if (!isValid) {
                e.preventDefault(); // Empêche l'envoi du formulaire
            }
        });
    });
});
