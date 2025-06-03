<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-card">
        <div class="text-center mb-4">
            <h3 class="mt-3">SIGN IN</h3>
        </div>
        <?php if (!empty($message)): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="/user/login">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="E-mail" required>
            </div>
            <div class="mb-4">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-gradient">SIGN IN</button>
            </div>

            <div class="mt-3">
                <a href="/user/register" class="text-info text-decoration-none small">Don't have an account?</a>
            </div>
        </form>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
