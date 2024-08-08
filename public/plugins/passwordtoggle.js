
    document.addEventListener("DOMContentLoaded", function() {
        // Find all password fields
        const passwordFields = document.querySelectorAll('input[type="password"]');
        
        passwordFields.forEach(passwordField => {
            // Create a toggle icon element
            const toggleIcon = document.createElement('span');
            toggleIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12m-7 7a7 7 0 0114 0m0 0a7 7 0 00-14 0m0 0a7 7 0 0014 0m0 0a7 7 0 01-14 0M3 3l18 18" />
                                    </svg>`;
            toggleIcon.classList.add('absolute', 'right-3', 'top-10', 'cursor-pointer', 'text-gray-500');

            // Wrap the password field in a relative div if not already wrapped
            const wrapper = document.createElement('div');
            wrapper.classList.add('relative');
            passwordField.parentNode.insertBefore(wrapper, passwordField);
            wrapper.appendChild(passwordField);
            wrapper.appendChild(toggleIcon);

            // Toggle password visibility on icon click
            toggleIcon.addEventListener('click', function() {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.classList.toggle('text-gray-500');
                this.classList.toggle('text-blue-500');
            });
        });
    });

