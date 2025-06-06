<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Create New Admin</h4>
        </div>
        <div class="card-body">
            <form action="/admin/manage-admins/store" method="POST" autocomplete="off">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" autocomplete="off" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Permissions</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="view_statistics"
                               id="perm_stats">
                        <label class="form-check-label" for="perm_stats">View Statistics</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="view_reports"
                               id="perm_reports">
                        <label class="form-check-label" for="perm_reports">View Reports</label>
                    </div>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="is_superadmin" value="1" id="is_super">
                    <label class="form-check-label" for="is_super">Super Admin</label>
                </div>
                <button type="submit" class="btn btn-success">Create Admin</button>
            </form>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const superCheckbox = document.getElementById('is_super');
                    const permissionChecks = document.querySelectorAll('input[name="permissions[]"]');

                    function togglePermissionsState() {
                        const disabled = superCheckbox.checked;
                        permissionChecks.forEach(cb => {
                            cb.disabled = disabled;
                            if (disabled) cb.checked = false;
                        });
                    }

                    superCheckbox.addEventListener('change', togglePermissionsState);
                    togglePermissionsState();
                });
            </script>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
