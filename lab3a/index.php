<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <!-- Add the Bulma CSS here -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
 
</head>
<body>
<section class="section">
    <h1 class="title">User Registration</h1>
    <h2 class="subtitle">
        This is the IPT10 PHP Quiz Web Application Laboratory Activity. Please register
    </h2>
    <!-- Supply the correct HTTP method and target form handler resource -->
    <form method="POST" action="instructions.php">
        <div class="field">
            <label class="label">Name</label>
            <div class="control">
                <input class="input" id="name" type="text" name="complete_name" placeholder="Complete Name" />
            </div>
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" id="email" name="email" type="email" placeholder="Email Address" />
            </div>
        </div>

        <div class="field">
            <label class="label">Birthdate</label>
            <div class="control">
                <input class="input" id="birthdate" name="birthdate" type="date" required/>
            </div>
        </div>

        <div class="field">
            <label class="label">Contact Number</label>
            <div class="control">
                <input class="input" id="contact_number" name="contact_number" type="tel" placeholder="Contact Number" required/>
            </div>
        </div>

        <!-- Next button -->
        <button type="submit" class="button is-link" id="nextButton" disabled>Proceed Next</button>
    </form>
</section>

<script>
   // Get references to the input fields and button
   const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const birthdateInput = document.getElementById('birthdate');
    const contactNumberInput = document.getElementById('contact_number');
    const nextButton = document.getElementById('nextButton');

    // Function to validate inputs
    function validateInputs() {
        const nameValue = nameInput.value.trim();
        const emailValue = emailInput.value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Basic validation
        const isNameValid = nameValue.length > 0;
        const isEmailValid = emailPattern.test(emailValue);

        // Enable or disable the button based on validation
        if (isNameValid && isEmailValid && birthdateInput.checkValidity() && contactNumberInput.checkValidity()) {
            nextButton.disabled = false;
        } else {
            nextButton.disabled = true;
        }

        // Update input field classes for visual feedback
        nameInput.className = 'input ' + (isNameValid ? 'valid' : 'invalid');
        emailInput.className = 'input ' + (isEmailValid ? 'valid' : 'invalid');
    }

    // Add event listeners to validate inputs on change
    nameInput.addEventListener('input', validateInputs);
    emailInput.addEventListener('input', validateInputs);

    // Add event listeners to handle required fields validation
    birthdateInput.addEventListener('input', validateInputs);
    contactNumberInput.addEventListener('input', validateInputs);

    // Initial validation check on page load
    validateInputs();
</script>

</body>
</html>