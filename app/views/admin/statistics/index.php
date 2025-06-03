<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4"> Statistics</h1>

    <form method="get" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" class="form-control" name="user_id" placeholder="User ID" value="<?= htmlspecialchars($filters['user_id'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <select class="form-select" name="action">
                <option value="">All Action</option>
                <option value="login" <?= $filters['action'] === 'login' ? 'selected' : '' ?>>Login</option>
                <option value="logout" <?= $filters['action'] === 'logout' ? 'selected' : '' ?>>Logout</option>
                <option value="registration" <?= $filters['action'] === 'registration' ? 'selected' : '' ?>>Registration</option>
                <option value="view-page" <?= $filters['action'] === 'view-page' ? 'selected' : '' ?>>View Page</option>
                <option value="button-click" <?= $filters['action'] === 'button-click' ? 'selected' : '' ?>>Button Click</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" class="form-control" name="date" value="<?= htmlspecialchars($filters['date'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>User ID</th>
            <th>Action</th>
            <th>Detail</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($events)): ?>
            <tr>
                <td colspan="5" class="text-center text-muted">No data to show</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?= $event['id'] ?></td>
                <td><?= $event['created_at'] ?></td>
                <td><?= $event['user_id'] ?></td>
                <td><?= $event['action'] ?></td>
                <td><?= $event['details'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
