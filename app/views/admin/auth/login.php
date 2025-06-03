<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #232933;
            --secondary-color: #f8f9fc;
            --accent-color: #232933;
        }

        body {
            background-image: linear-gradient(205deg, #15bcdf4d, #15bcdf0d 50%, #30e9be4d);
            height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-card {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .login-card-img {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-card-body {
            padding: 2rem;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
        }

        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
            background-color: var(--primary-color);
            border: none;
        }

        .btn-login:hover {
            background-color: var(--accent-color);
        }

        .form-floating label {
            padding: 0.75rem 1rem;
        }

        .input-group-text {
            background-color: transparent;
            border-right: none;
        }

        .input-group .form-control {
            border-left: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-lg-5 d-none d-lg-block">
                        <div class="login-card-img h-100">
                            <div class="text-center">
                                <h2>Admin</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card-body p-sm-5 login-card-body">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold">Welcome Back</h2>
                                <p class="text-muted">Please enter your username and password</p>
                            </div>
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= htmlspecialchars($error) ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <form method="POST" action="/admin/login" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                                        <div class="invalid-feedback">
                                            Please enter your username.
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 position-relative">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        <input type="password" class="form-control pe-5" id="password" name="password" placeholder="Enter your password" required>
                                        <div class="invalid-feedback">
                                            Please enter your password.
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid mb-3">
                                    <button class="btn btn-primary btn-login fw-bold" type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Form validation
    (function () {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
</body>
</html>