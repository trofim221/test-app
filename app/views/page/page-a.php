<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container text-center mt-5">
    <h2>Page A — Buy a cow</h2>
    <?php if (!empty($_GET['bought'])): ?>
        <div class="alert alert-success mt-4">Дякуємо за покупку!</div>
    <?php else: ?>
        <form method="post" action="/buy-cow">
            <button type="submit" class="btn btn-primary mt-4">Buy a cow</button>
        </form>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
