<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Reports</h1>

    <canvas id="activityChart" height="100"></canvas>

    <hr class="my-4">

    <h4>Table Report</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>Date</th>
            <th>Views Page A</th>
            <th>Views Page B</th>
            <th>Click “Buy a cow”</th>
            <th>Click “Download”</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($reportData as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['date']) ?></td>
                <td><?= $row['page_a_views'] ?></td>
                <td><?= $row['page_b_views'] ?></td>
                <td><?= $row['cow_clicks'] ?></td>
                <td><?= $row['download_clicks'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('activityChart').getContext('2d');
    const data = <?= json_encode($reportData) ?>;

    const labels = data.map(row => row.date);
    const pageA = data.map(row => parseInt(row.page_a_views));
    const pageB = data.map(row => parseInt(row.page_b_views));
    const buyCow = data.map(row => parseInt(row.cow_clicks));
    const download = data.map(row => parseInt(row.download_clicks));

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels.reverse(),
            datasets: [
                {
                    label: 'Page A Views',
                    data: pageA.reverse(),
                    borderWidth: 2
                },
                {
                    label: 'Page B Views',
                    data: pageB.reverse(),
                    borderWidth: 2
                },
                {
                    label: 'Buy a Cow Clicks',
                    data: buyCow.reverse(),
                    borderWidth: 2
                },
                {
                    label: 'Download Clicks',
                    data: download.reverse(),
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
