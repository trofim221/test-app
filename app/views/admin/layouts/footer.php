
<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle sidebar on mobile
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('mainContent').classList.toggle('active');
    });

    document.getElementById('sidebarClose').addEventListener('click', function() {
        document.getElementById('sidebar').classList.remove('active');
        document.getElementById('mainContent').classList.remove('active');
    });
</script>
</body>
</html>