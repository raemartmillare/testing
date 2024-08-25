// Get references to the input fields and button
const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const nextButton = document.getElementById('nextButton');

// Function to validate inputs
function validateInputs() {
    const nameValue = nameInput.value.trim();
    const emailValue = emailInput.value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Check if both fields are filled and email is valid
    const isNameValid = nameValue.length > 0;
    const isEmailValid = emailPattern.test(emailValue);

    // Enable or disable the button based on validation
    nextButton.disabled = !(isNameValid && isEmailValid);
}

// Add event listeners to validate inputs on change
nameInput.addEventListener('input', validateInputs);
emailInput.addEventListener('input', validateInputs);

// Initial validation check on page load
validateInputs();
