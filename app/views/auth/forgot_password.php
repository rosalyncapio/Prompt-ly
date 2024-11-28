<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .forgot-password-container {
            max-width: 400px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .forgot-password-container h5 {
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

        .form-text {
            font-size: 0.875rem;
            color: #718096;
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

        .popup {
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #f44336;
            color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000;
            max-width: 300px;
        }

        .hidden {
            display: none;
        }

        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .description-text {
            text-align: center;
            color: #718096;
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }
    </style>
</head>

<body>
    <div class="forgot-password-container">
        <h5>Forgot Password</h5>
        <p class="description-text">
            Enter your email address and we'll send you a link to reset your password.
        </p>

        <form action="<?= site_url('forgot-password'); ?>" method="post">
            <div class="mb-4">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" required>
                <div id="emailHelpBlock" class="form-text mt-1">
                    We'll send a password reset link to this email address.
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Send Reset Link</button>
            </div>

            <div class="account-link">
                <a href="<?= site_url('login'); ?>">Back to Login</a>
            </div>
        </form>

        <!-- Popup for Flash Messages -->
        <div id="popup-message" class="popup hidden">
            <span id="popup-text"></span>
            <button onclick="closePopup()" class="close-btn">&times;</button>
        </div>
    </div>

    <script>
        // Display popup if there's an error message
        function showPopup(message) {
            const popup = document.getElementById('popup-message');
            const text = document.getElementById('popup-text');
            text.textContent = message;
            popup.classList.remove('hidden');

            // Hide popup after 5 seconds
            setTimeout(closePopup, 5000);
        }

        // Close the popup
        function closePopup() {
            document.getElementById('popup-message').classList.add('hidden');
        }

        window.onload = function() {
            <?php if ($this->session->flashdata('error')): ?>
                showPopup("<?= $this->session->flashdata('error'); ?>");
            <?php elseif ($this->session->flashdata('success')): ?>
                showPopup("<?= $this->session->flashdata('success'); ?>");
            <?php endif; ?>
        };

        $(document).ready(function() {
            <?php if ($this->session->flashdata('success')): ?>
                toastr.success('<?= $this->session->flashdata('success') ?>');
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                toastr.error('<?= $this->session->flashdata('error') ?>');
            <?php endif; ?>
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
</body>

</html>