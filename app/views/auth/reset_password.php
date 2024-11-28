<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Promptly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0a192f;
            color: #e6f1ff;
        }
        .reset-password-container {
            max-width: 450px;
            margin: 50px auto;
            padding: 2rem;
            background-color: #112240;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        .form-control {
            background-color: #233554;
            border: none;
            color: #e6f1ff;
            padding: 0.75rem 1rem;
        }
        .form-control:focus {
            background-color: #2a4065;
            color: #e6f1ff;
            box-shadow: 0 0 0 2px #64ffda;
        }
        .btn-primary {
            background-color: #64ffda;
            border: none;
            color: #0a192f;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #4ccea6;
            color: #0a192f;
        }
        .alert {
            border: none;
            border-radius: 10px;
        }
        .alert-success {
            background-color: rgba(100, 255, 218, 0.1);
            color: #64ffda;
        }
        .alert-danger {
            background-color: rgba(255, 107, 107, 0.1);
            color: #ff6b6b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="reset-password-container">
            <h2 class="text-center mb-4">Reset Password</h2>


            <form action="<?= site_url('reset-password/' . $token) ?>" method="POST">
                <input type="hidden" name="token" value="<?= $token ?>">
                
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" required 
                           minlength="8" placeholder="Enter new password">
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                           required minlength="8" placeholder="Confirm new password">
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>

                <div class="text-center mt-3">
                    <a href="<?= site_url('auth/login') ?>" class="text-decoration-none" style="color: #64ffda;">
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password confirmation validation
        document.getElementById('confirm_password').addEventListener('input', function() {
            if (this.value !== document.getElementById('password').value) {
                this.setCustomValidity('Passwords do not match');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html>