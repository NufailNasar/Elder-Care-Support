<?php
session_start();
include('header.php');
include('../connection.php'); // Ensure DB connection is established

// Initialize variables for filter values
$donorFilter = $_GET['donor'] ?? 'All donors';
$dateFrom = $_GET['date_from'] ?? '';
$dateTo = $_GET['date_to'] ?? '';
$donationTypeFilter = $_GET['donation_type'] ?? 'All types';

// Build SQL query based on filters
$whereClauses = [];
if ($donorFilter !== 'All donors') {
    $whereClauses[] = "d.donor_email = '$donorFilter'";
}
if ($dateFrom && $dateTo) {
    $whereClauses[] = "d.created_at BETWEEN '$dateFrom' AND '$dateTo'";
}
if ($donationTypeFilter !== 'All types') {
    $whereClauses[] = "d.donation_type = '$donationTypeFilter'";
}

$whereSql = "";
if (count($whereClauses) > 0) {
    $whereSql = "WHERE " . implode(" AND ", $whereClauses);
}

// Fetch donation records based on filters
$query = "
    SELECT d.donor_name, d.donor_email, d.donation_type, d.amount, d.created_at, e.name AS elder_home
    FROM donations d
    JOIN elder_homes e ON d.elder_home_id = e.id
    $whereSql
    ORDER BY d.created_at DESC
";

$donationResults = mysqli_query($link, $query);

// Fetch all registered donors for the Donor filter dropdown
$donorsQuery = "SELECT DISTINCT donor_email, donor_name FROM donations";
$donorsResult = mysqli_query($link, $donorsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <!-- Add SheetJS and jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
<body>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Report Generation</h1>
    <p class="text-muted">Filter, view and export donation records</p>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Report Generation</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section report-section">
    <div class="card mb-4">
      <div class="card-body pt-4">
        <h5 class="card-title">Filters</h5>
        <form class="row g-3" method="GET" action="ReportGeneration.php">
          <!-- Donor Filter -->
          <div class="col-md-3">
            <label class="form-label">Donor</label>
            <select class="form-select" name="donor">
              <option value="All donors" <?= $donorFilter === 'All donors' ? 'selected' : '' ?>>All donors</option>
              <?php while ($row = mysqli_fetch_assoc($donorsResult)) { ?>
                <option value="<?= $row['donor_email'] ?>" <?= $donorFilter === $row['donor_email'] ? 'selected' : '' ?>><?= htmlspecialchars($row['donor_name']) ?> (<?= htmlspecialchars($row['donor_email']) ?>)</option>
              <?php } ?>
            </select>
          </div>

          <!-- Date Range Filter -->
          <div class="col-md-3">
            <label class="form-label">Date Range</label>
            <div class="input-group">
              <input type="date" class="form-control" name="date_from" value="<?= $dateFrom ?>">
              <input type="date" class="form-control" name="date_to" value="<?= $dateTo ?>">
            </div>
          </div>

          <!-- Donation Type Filter -->
          <div class="col-md-3">
            <label class="form-label">Donation Type</label>
            <select class="form-select" name="donation_type">
              <option value="All types" <?= $donationTypeFilter === 'All types' ? 'selected' : '' ?>>All types</option>
              <option value="Monetary" <?= $donationTypeFilter === 'Monetary' ? 'selected' : '' ?>>Monetary</option>
              <option value="Items" <?= $donationTypeFilter === 'Items' ? 'selected' : '' ?>>Items</option>
              <option value="Food" <?= $donationTypeFilter === 'Food' ? 'selected' : '' ?>>Food</option>
            </select>
          </div>

          <!-- Generate Button -->
          <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">Generate</button>
            <button type="button" class="btn btn-outline-secondary" id="exportExcel">Export Excel</button>
            <button type="button" class="btn btn-outline-danger" id="exportPDF">Export PDF</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Results Table -->
    <div class="card">
      <div class="card-body pt-3">
        <h5 class="card-title">Results</h5>
        <div class="table-responsive">
          <table class="table table-bordered align-middle" id="reportTable">
            <thead>
              <tr>
                <th>Donor</th>
                <th>Email</th>
                <th>Donations</th>
                <th>Date</th>
                <th>Elder Home</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($donationResults)) { ?>
                <tr>
                  <td><?= htmlspecialchars($row['donor_name']) ?></td>
                  <td><?= htmlspecialchars($row['donor_email']) ?></td>
                  <td><?= $row['donation_type'] === 'money' ? 'LKR ' . number_format($row['amount'], 2) : htmlspecialchars($row['donation_type']) ?></td>
                  <td><?= date('Y-m-d h:i A', strtotime($row['created_at'])) ?></td>
                  <td><?= htmlspecialchars($row['elder_home']) ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
// Initialize DataTable
$(document).ready(function() {
  $('#reportTable').DataTable({
    dom: 'Bfrtip',
    buttons: ['excel', 'pdf', 'print']
  });

  // Export to Excel
  $('#exportExcel').on('click', function() {
    const table = $('#reportTable').DataTable();
    const data = table.rows().data().toArray();
    const ws = XLSX.utils.aoa_to_sheet(data);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Donations');
    XLSX.writeFile(wb, 'donation_report.xlsx');
  });

  // Export to PDF
  $('#exportPDF').on('click', function() {
    const table = $('#reportTable').DataTable();
    const data = table.rows().data().toArray();
    const doc = new jsPDF();
    doc.autoTable({
      head: [['Donor', 'Email', 'Donations', 'Date', 'Elder Home']],
      body: data.map(row => [row[0], row[1], row[2], row[3], row[4]])
    });
    doc.save('donation_report.pdf');
  });
});
</script>

</body>
</html>

<?php include('footer.php'); ?>
