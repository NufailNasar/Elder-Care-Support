<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
?>

<body>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Donations Received</h1>
    <p class="text-muted">View and manage donations received by your elder home</p>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Donations Received</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section donations-section">

    <!-- Filters Card -->
    <div class="card mb-4">
      <div class="card-body pt-4">
        <h5 class="card-title">Filter Donations</h5>
        <form class="row g-3">

          <div class="col-md-4">
            <label for="donationType" class="form-label">Donation Type</label>
            <select id="donationType" class="form-select" aria-label="Filter by donation type">
              <option value="all" selected>All Types</option>
              <option value="monetary">Monetary</option>
              <option value="items">Items</option>
              <option value="food">Food</option>
              <option value="medical">Medical Supplies</option>
            </select>
          </div>

          <div class="col-md-4">
            <label for="statusFilter" class="form-label">Fulfillment Status</label>
            <select id="statusFilter" class="form-select" aria-label="Filter by fulfillment status">
              <option value="all" selected>All</option>
              <option value="fulfilled">Fulfilled</option>
              <option value="partial">Partially Fulfilled</option>
              <option value="pending">Pending</option>
            </select>
          </div>

          <div class="col-md-4 d-flex align-items-end">
            <button type="button" class="btn btn-primary me-2" id="btnFilter">Apply Filter</button>
            <button type="button" class="btn btn-outline-secondary" id="btnReset">Reset</button>
          </div>

        </form>
      </div>
    </div>

    <!-- Donations Table -->
    <div class="card">
      <div class="card-body pt-3">
        <h5 class="card-title">Donations List</h5>
        <div class="table-responsive">
          <table class="table table-bordered align-middle" id="donationsTable" aria-describedby="donationsTableInfo">
            <thead>
              <tr>
                <th scope="col">Donor Name</th>
                <th scope="col">Email</th>
                <th scope="col">Donation Details</th>
                <th scope="col">Date Received</th>
                <th scope="col">Quantity / Amount</th>
                <th scope="col">Fulfillment Status</th>
              </tr>
            </thead>
            <tbody>
              <tr data-type="monetary" data-status="fulfilled">
                <td>James Walker</td>
                <td>jamesw@example.com</td>
                <td>Monetary Donation</td>
                <td>2025 April 22 – 2:41 PM</td>
                <td>LKR 150,000</td>
                <td><span class="badge bg-success">Fulfilled</span></td>
              </tr>
              <tr data-type="monetary" data-status="pending">
                <td>Ayesha Perera</td>
                <td>ayesha@example.com</td>
                <td>Monetary Donation</td>
                <td>2025 May 09 – 9:45 PM</td>
                <td>LKR 50,000</td>
                <td><span class="badge bg-danger">Pending</span></td>
              </tr>
              <tr data-type="medical" data-status="partial">
                <td>Rajiv Fernando</td>
                <td>rajivf@example.com</td>
                <td>Medical Supplies</td>
                <td>2025 June 11 – 7:00 PM</td>
                <td>15/30 Boxes</td>
                <td><span class="badge bg-warning text-dark">Partial</span></td>
              </tr>
              <tr data-type="food" data-status="fulfilled">
                <td>Mary Clarke</td>
                <td>mary@example.com</td>
                <td>Food Donation (Rice)</td>
                <td>2025 March 02 – 2:20 PM</td>
                <td>50 KG</td>
                <td><span class="badge bg-success">Fulfilled</span></td>
              </tr>
              <tr data-type="items" data-status="fulfilled">
                <td>James Walker</td>
                <td>jamesw@example.com</td>
                <td>Furniture - Beds</td>
                <td>2025 May 07 – 2:30 PM</td>
                <td>110 Units</td>
                <td><span class="badge bg-success">Fulfilled</span></td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Export Buttons -->
        <div class="text-end mt-3">
          <button class="btn btn-outline-danger me-2" id="exportPdfBtn"><i class="bi bi-file-earmark-pdf"></i> Export PDF</button>
          <button class="btn btn-outline-success" id="exportExcelBtn"><i class="bi bi-file-earmark-excel"></i> Export Excel</button>
        </div>
      </div>
    </div>

  </section>
</main>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Optional JS for Filtering & Export - simple example -->
<script>
  document.getElementById('btnFilter').addEventListener('click', () => {
    const typeFilter = document.getElementById('donationType').value;
    const statusFilter = document.getElementById('statusFilter').value;

    const rows = document.querySelectorAll('#donationsTable tbody tr');

    rows.forEach(row => {
      const type = row.getAttribute('data-type');
      const status = row.getAttribute('data-status');

      const typeMatches = (typeFilter === 'all' || type === typeFilter);
      const statusMatches = (statusFilter === 'all' || status === statusFilter);

      if(typeMatches && statusMatches) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });

  document.getElementById('btnReset').addEventListener('click', () => {
    document.getElementById('donationType').value = 'all';
    document.getElementById('statusFilter').value = 'all';
    document.getElementById('btnFilter').click();
  });

  // Placeholder export handlers - integrate with your backend or JS libraries as needed
  document.getElementById('exportPdfBtn').addEventListener('click', () => {
    alert('Export to PDF functionality to be implemented.');
  });

  document.getElementById('exportExcelBtn').addEventListener('click', () => {
    alert('Export to Excel functionality to be implemented.');
  });
</script>




</body>

</html>

<?php
include('footer.php');
?>