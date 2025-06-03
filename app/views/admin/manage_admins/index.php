<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Admin List</h4>
            <a href="/admin/manage-admins/create" class="btn btn-success">+ Create New Admin</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Superadmin</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($admins as $admin): ?>
                    <tr>
                        <td><?= $admin['id'] ?></td>
                        <td><?= htmlspecialchars($admin['username']) ?></td>
                        <td><?= htmlspecialchars($admin['email']) ?></td>
                        <td><?= $admin['is_superadmin'] ? '✅' : '' ?></td>
                        <td><?= $admin['created_at'] ?></td>
                        <td>
                            <a href="/admin/manage-admins/edit/<?= $admin['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <?php if ((int)$admin['id'] !== (int)$_SESSION['admin_id']): ?>
                                <a href="/admin/manage-admins/delete/<?= $admin['id'] ?>" class="btn btn-sm btn-danger"
                                   onclick="return confirm('Are you sure you want to delete this admin?')">Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
