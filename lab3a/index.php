<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <!-- Add the Bulma CSS here -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
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
                <input class="input" type="text" name="complete_name" placeholder="Complete Name">
            </div>
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" name="email" type="email" />
            </div>
        </div>

        <div class="field">
            <label class="label">Birthdate</label>
            <div class="control">
                <input class="input" name="birthdate" type="date" />
            </div>
        </div>

        <div class="field">
            <label class="label">Contact Number</label>
            <div class="control">
                <input class="input" name="contact_number" type="number" />
            </div>
        </div>

        <!-- Next button -->
        <button type="submit" class="button is-link" id="submit_btn" disabled>Proceed Next</button>
    </form>
</section>

<script>
    const name_input = document.getElementsByName('complete_name')[0];
    const email_input = document.getElementsByName('email')[0];
    const birthdate_input = document.getElementsByName('birthdate')[0];
    const contactNumber_input = document.getElementsByName('contact_number')[0];
    const submit_btn = document.getElementById('submit_btn');

    function validateForm() {
        const name = name_input.value.trim();
        const email = email_input.value.trim();
        const birthdate = birthdate_input.value.trim();
        const contact_number = contactNumber_input.value.trim();

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (name !== '' && emailPattern.test(email) && birthdate !== '' && contact_number !== '') {
            submit_btn.disabled = false;
        } else {
            submit_btn.disabled = true;
        }
    }

    name_input.addEventListener('input', validateForm);
    email_input.addEventListener('input', validateForm);
    birthdate_input.addEventListener('input', validateForm);
    contactNumber_input.addEventListener('input', validateForm);
</script>

</body>
</html>