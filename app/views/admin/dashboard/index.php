<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Admin Dashboard</h1>


    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text fs-4"><?= $userCount ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Events</h5>
                    <p class="card-text fs-4"><?= $eventCount ?></p>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-3">Recent User Actions</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
            <tr>
                <th>User ID</th>
                <th>Action</th>
                <th>Details</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($recentEvents as $event): ?>
                <tr>
                    <td><?= $event['user_id'] ?></td>
                    <td><?= $event['action'] ?></td>
                    <td><?= $event['details'] ?></td>
                    <td><?= $event['created_at'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
