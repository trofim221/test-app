<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-card">

    <h3 class="fw-bold mb-4">CREATE ACCOUNT</h3>

    <form method="POST" action="/user/register" novalidate>
        <div class="mb-3">
            <input type="text" name="username" class="form-control" placeholder="Full Name" required>
        </div>
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-gradient">CONTINUE</button>

        <div class="mt-3">
            <a href="/user/login" class="text-info text-decoration-none small">I already have an account</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
