<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .login-container h5 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #4a5568;
        }

        .form-label {
            font-weight: 500;
            color: #4a5568;
        }

        .form-control {
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-primary {
            background-color: #667eea;
            border-color: #667eea;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #5a67d8;
            border-color: #5a67d8;
            transform: translateY(-2px);
        }

        .input-group-text {
            background-color: #edf2f7;
            border: 1px solid #e2e8f0;
            border-radius: 0 0.5rem 0.5rem 0;
        }

        .form-text {
            font-size: 0.875rem;
            color: #718096;
        }

        .password-error {
            color: #e53e3e;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .account-link {
            text-align: center;
            margin-top: 1rem;
        }

        .account-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .account-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h5>Welcome Back!</h5>
        <form action="<?= site_url('login'); ?>" method="post">
            <div class="mb-4">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" aria-describedby="emailHelpBlock" required>
                <div id="emailHelpBlock" class="form-text mt-1">
                    <!-- Please enter your email to log in and access your account. -->
                </div>
            </div>

            <div class="mb-4">
                <label for="inputPassword5" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" id="inputPassword5" name="password" class="form-control" minlength="8" required>
                    <button type="button" id="togglePassword" class="input-group-text">
                        <i class="fas fa-eye" id="passwordToggleIcon"></i>
                    </button>
                </div>
                <div id="passwordErrorMessage" class="password-error"></div>
                <div id="passwordHelpBlock" class="form-text mt-1">
                    <!-- Your password must be at least 8 characters long and include letters, numbers, and special characters. -->
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

            <div class="account-link">
                <a href="/register">New here? Sign up today!</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById("togglePassword").addEventListener("click", togglePasswordVisibility);

        function validatePassword() {
            const passwordInput = document.getElementById("inputPassword5");
            const password = passwordInput.value;

            // Regular expressions for password requirements
            const specialCharacterRegex = /[!@#\$%\^&\*()_\-+\{\}\|\[\]:;"'<>,\./]/;
            const numberRegex = /[0-9]/;
            const uppercaseLetterRegex = /[A-Z]/;
            const lowercaseLetterRegex = /[a-z]/;

            if (
                specialCharacterRegex.test(password) &&
                numberRegex.test(password) &&
                uppercaseLetterRegex.test(password) &&
                lowercaseLetterRegex.test(password) &&
                password.length >= 8
            ) {
                document.getElementById("passwordErrorMessage").textContent = "";
                return true; // Allow form submission
            } else {
                document.getElementById("passwordErrorMessage").textContent =
                    "Your password must be at least 8 characters long and include at least one special character, one number, one uppercase letter, and one lowercase letter.";
                return false; // Prevent form submission
            }
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("inputPassword5");
            const passwordToggleIcon = document.getElementById("passwordToggleIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggleIcon.classList.remove("fa-eye");
                passwordToggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                passwordToggleIcon.classList.remove("fa-eye-slash");
                passwordToggleIcon.classList.add("fa-eye");
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>