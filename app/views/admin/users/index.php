<?php include __DIR__ . '/../layouts/header.php'; ?>
    <div class="container mt-4">
        <h1 class="mb-4"> Users</h1>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Registered At</th></tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['created_at'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>