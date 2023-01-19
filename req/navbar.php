<?php
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>

    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasExample">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-haze2-fill" viewBox="0 0 16 16">
                    <path d="M8.5 2a5.001 5.001 0 0 1 4.905 4.027A3 3 0 0 1 13 12H3.5A3.5 3.5 0 0 1 .035 9H5.5a.5.5 0 0 0 0-1H.035a3.5 3.5 0 0 1 3.871-2.977A5.001 5.001 0 0 1 8.5 2zm-6 8a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zM0 13.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5z" />
                </svg>
            </button>
            <a class="navbar-brand" href="#">
                User: <?php echo $_SESSION['name']; ?>
            </a>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Lycoris Cafe</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-grid gap-2">
                <a class="btn btn-primary btn-sm" aria-current="page" href="../view/Admin.php">Dashboard</a>
                <a class="btn btn-primary btn-sm" aria-current="page" href="../req/Students.php">Students</a>
                <a class="btn btn-primary btn-sm" aria-current="page" href="../req/attendanceReport.php">Attendance Report</a>
                <a class="btn btn-primary btn-sm" aria-current="page" href="../req/newStudent1.php">Add a New Student</a>
                <a class="btn btn-primary btn-sm" aria-current="page" href="../req/studentsInfo.php">Student Information</a>
                <a class="btn btn-primary btn-sm" aria-current="page" href="../req/addClass.php">Classes</a>
                <a class="btn btn-primary btn-sm" aria-current="page" href="../req/exams.php">Exams</a>
                <a class="btn btn-primary btn-sm" aria-current="page" href="../req/accounts.php">Accounts</a>
                <a class="btn btn-outline-danger btn-sm" aria-current="page" href="../req/logout.php">Logout</a>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>