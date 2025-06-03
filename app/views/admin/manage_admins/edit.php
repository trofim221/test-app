<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-5">
    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Admin</h4>
        </div>

        <div class="card-body">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="/admin/manage-admins/update/<?= $admin['id'] ?>" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" name="username" id="username" class="form-control"
                   value="<?= htmlspecialchars($admin['username']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control"
                   value="<?= htmlspecialchars($admin['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password:</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>



        <?php if (!$admin['is_superadmin']): ?>

            <div class="form-check mb-3">
                <input type="checkbox" name="is_superadmin" class="form-check-input" id="is_superadmin"
                    <?= $admin['is_superadmin'] ? 'checked' : '' ?>>
                <label class="form-check-label" for="is_superadmin">Super Admin</label>
            </div>
            <div class="mb-3">
                <label class="form-label">Permissions:</label><br>
                <?php
                $allPermissions = ['view_statistics', 'view_reports'];
                foreach ($allPermissions as $perm):
                    ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox"
                               name="permissions[]" value="<?= $perm ?>"
                            <?= in_array($perm, $admin['permissions'] ?? []) ? 'checked' : '' ?>>
                        <label class="form-check-label"><?= ucfirst(str_replace('_', ' ', $perm)) ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/admin/manage-admins" class="btn btn-secondary">Cancel</a>
    </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
